<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\WebInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebInfoController extends Controller
{
  const MODULE = 'webinfo';

  public function index()
  {
    $this->authorize(mapPermission(self::MODULE));
    $webinfo = WebInfo::find(1)->first();

    return view('backend.webinfo.update', compact('webinfo'));
  }

  public function update(Request $request, WebInfo $webinfo)
  {
    $this->authorize(mapPermission(self::MODULE));
    $webinfo->update($this->validateRequest());
    $webinfo->storeImage();

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.webinfo.index'));
  }

  private function validateRequest() {
    $validatedData = request()->validate([
      "name_th"               => "required",
      "name_en"               => "required",
      "description_th"        => "required",
      "description_en"        => "required",
      "copyright_th"          => "required",
      "copyright_en"          => "required",
      "company_name_th"       => "",
      "company_name_en"       => "",
      "company_address_th"    => "",
      "company_address_en"    => "",
      "company_tax_code"      => "",
      "company_email"         => ["email","required"],
      "company_tel"           => "",
      "company_fax"           => "",
      "company_gmap_location" => "",
    ]);

    $validatedData['updated_by'] = Auth::id();
    $validateImg = request()->validate([
      "image_logo_head"       => ['sometimes', 'file','image','max:500'],
      "image_logo_foot"       => ['sometimes', 'file','image','max:500'],
    ]);

    return $validatedData;
  }

}

