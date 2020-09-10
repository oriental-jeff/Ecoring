<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function upload(Request $request)
    {
      $path = storage_path('tmp/uploads');
      if (!file_exists($path)) :
        mkdir($path, 0777, true);
      endif;
      $file = $request->file('file');
      $name = uniqid() . '_' . trim($file->getClientOriginalName());
      $file->move($path, $name);
      return response()->json([
          'name'          => $name,
          'original_name' => $file->getClientOriginalName(),
      ]);
    }
}
