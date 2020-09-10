<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Gallery;

class GalleryController extends Controller
{
  public function index()
  {
    return redirect(route('backend.gallery.edit',['gallery' => 1]));
  }

  public function edit(Gallery $gallery)
  {
    return view('backend.gallery.update', compact('gallery'));
  }
  
  public function update(Request $request, Gallery $gallery)
  {
    if (collect($gallery->image)->count() > 0) {
      foreach ($gallery->image as $media) {
        if (!in_array($media->file_name, $request->input('image', []))) {
            $media->delete();
        }
      }
    }

    $media = $gallery->image->pluck('file_name')->toArray();

    foreach ($request->input('image', []) as $file) {
      if (count($media) === 0 || !in_array($file, $media)) {
        $gallery->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
      }
    }
    deleteImageTmp();

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.gallery.index'));
  }
}
