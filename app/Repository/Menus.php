<?php

namespace App\Repository;

use App\Model\Menu;
use Carbon\Carbon;

class Menus {
   
  CONST CACHE_KEY = 'menus';

  public function all($orderBy)
  {
    $key = "all.{$orderBy}";
    $cacheKey = $this->getCacheKey($key);
    // cache()->forget($cacheKey);
    
    $menus = cache()->remember($cacheKey, Carbon::now()->addDays(7), function () use($orderBy){
      return Menu::with(['childrens', 'pages'])
        ->onlyParent()
        ->onlyActive()
        ->orderBy($orderBy)
        ->get();
    });

    return $menus;
  }

  public function get($id)
  {
    $key = "get.{$id}";
    $cacheKey = $this->getCacheKey($key);

    $menus = cache()->remember($cacheKey, Carbon::now()->addDays(7), function () use($id){
      return Menu::find($id);
      // return Menu::with('')->where('id', $id)->first();
    });

    return $menus;
  }

  public function getCacheKey($key)
  {
    return self::CACHE_KEY . ".$key";
  }

}