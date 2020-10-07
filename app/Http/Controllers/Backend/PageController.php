<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
  const MODULE = 'page';

  public function index(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')) :
      $pages = Page::getDataByKeyword($request->keyword)->get();
    else:
      $pages = Page::limit(50)->get();
    endif;

    return view('backend.page.index', compact('pages'));
  }

  public function create(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    $page = new Page;

    return view('backend.page.create', compact('page'));
  }

  public function store(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    $page = Page::create($this->validateRequest());
    Cache::flush();

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.page.index'));
  }

  public function edit(Page $page)
  {
    $this->authorize(mapPermission(self::MODULE));

    return view('backend.page.update', compact('page'));
  }

  public function update(Request $request, Page $page)
  {
    $this->authorize(mapPermission(self::MODULE));
    $page->update($this->validateRequest());
    Cache::flush();

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.page.index'));
  }

  public function destroy(Page $page)
  {
    $this->authorize(mapPermission(self::MODULE));
    $page->delete();

    return redirect(route('backend.page.index'));
  }

  private function validateRequest()
  {
    $validatedData = request()->validate([
      "name"                => "required",
      "route_name"          => "",
      "active"              => "",
      "title_th"            => "",
      "title_en"            => "",
      "title_cn"            => "",
      "meta_title_th"       => "",
      "meta_title_en"       => "",
      "meta_title_cn"       => "",
      "meta_description_th" => "",
      "meta_description_en" => "",
      "meta_description_cn" => "",
      "meta_keyword_th"     => "",
      "meta_keyword_en"     => "",
      "meta_keyword_cn"     => "",
    ]);

    $validatedData['updated_by'] = Auth::id();
    if(request()->route()->getActionMethod() == 'store') :
      $validatedData['created_by'] = Auth::id();
    endif;

    return $validatedData;
  }

}

