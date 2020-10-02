<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\WebSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebSocialController extends Controller
{
  const MODULE = 'websocial';

  public function index(Request $request) 
  {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')) :
      $websocials = WebSocial::getDataByKeyword($request->keyword)->get();
    else:
      $websocials = WebSocial::limit(50)->get();
    endif;

    return view('backend.websocial.index', compact('websocials'));
  }

  public function create() {
    $this->authorize(mapPermission(self::MODULE));
    $websocial = new WebSocial;

    return view('backend.websocial.create', compact('websocial'));
  }

  public function store(Request $request) {
    $this->authorize(mapPermission(self::MODULE));
    $websocial = WebSocial::create($this->validateRequest());
    $websocial->storeImage();

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.websocial.index'));
  }

  public function edit(WebSocial $websocial)
  {
    $this->authorize(mapPermission(self::MODULE));

    return view('backend.websocial.update', compact('websocial'));
  }

  public function update(Request $request, WebSocial $websocial)
  {
    $this->authorize(mapPermission(self::MODULE));
    $websocial->update($this->validateRequest());
    $websocial->storeImage();

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.websocial.index'));
  }

  public function destroy(WebSocial $websocial)
  {
    $this->authorize(mapPermission(self::MODULE));
    $websocial->delete();

    return redirect(route('backend.websocial.index'));
  }

  private function validateRequest()
  {
    $validatedDate = request()->validate([
      "name"   => "required",
      "url"    => "",
      "active" => "",
    ]);

    request()->validate([
      "image"  => ['sometimes', 'file','image','max:5000'],
    ]);

    $validatedDate['updated_by'] = Auth::id();
    if(request()->route()->getActionMethod() == 'store') :
      $validatedDate['created_by'] = Auth::id();
    endif;

    return $validatedDate;
  }

}

