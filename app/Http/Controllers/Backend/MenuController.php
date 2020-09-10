<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
  public function index(Request $request)
  {
    $this->authorize('update menu');
    $menus = Menu::with(['pages', 'childrens'])
              ->onlyParent()
              ->orderBy('sort')
              ->get();

    return view('backend.menu.index', compact('menus'));
  }

  public function change_position(Request $request) {
    foreach (collect($request->data) as $key => $data) :
      Menu::find(collect($data)['id'])->update(['sort' => $key]);
      if(!empty(collect($data)['children'])) :
        foreach (collect($data)['children'] as $key_child => $child) :
          Menu::find(collect($child)['id'])->update(['sort' => $key_child]);
        endforeach;
      endif;
    endforeach;

    Cache::flush();
  }

  public function edit_name(Request $request) {
    $menu = Menu::find($request->id);

    return $menu->toJson();
  }

  public function update_name(Request $request) {
    $menu = Menu::find($request->id);
    $menu->name_th = $request->name_th;
    $menu->name_en = $request->name_en;
    $menu->save();
    Cache::flush();

    return $menu->toJson();
  }

}

