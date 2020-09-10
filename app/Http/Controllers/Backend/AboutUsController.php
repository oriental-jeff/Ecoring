<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
  const MODULE = 'about';

  public function index()
  {
    $this->authorize(mapPermission(self::MODULE));
    $about = AboutUs::find(1)->first();

    return view('backend.about_us.update', compact('about'));
  }

  public function update(Request $request, AboutUs $about)
  {
    $this->authorize(mapPermission(self::MODULE));
    $about->update($this->validateRequest());
    $about->storeImage();

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.about.index'));
  }

  private function validateRequest()
  {
    $validatedData = request()->validate([
      "title_th"               => "required",
      "title_en"               => "required",
      "type_th"                => "required",
      "type_en"                => "required",
      "description1_th"        => "required",
      "description1_en"        => "required",
      "description2_th"        => "required",
      "description2_en"        => "required",
      "description3_th"        => "required",
      "description3_en"        => "required",
    ]);

    $validatedData['updated_by'] = Auth::id();
    $validateImg = request()->validate([
      "image1"       => ['sometimes', 'file','image','max:5000'],
      "image2"       => ['sometimes', 'file','image','max:5000'],
      "image3"       => ['sometimes', 'file','image','max:5000'],
    ]);

    return $validatedData;
  }

}

