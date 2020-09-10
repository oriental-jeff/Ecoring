<?php

namespace App\Repository;

use App\Model\Page;
use Carbon\Carbon;

class Pages {
   
  CONST CACHE_KEY = 'pages';

  public function get($page)
  {
    $key = "get.{$page}";
    $cacheKey = $this->getCacheKey($key);
    // cache()->forget($cacheKey);
    
    $banners = cache()->remember($cacheKey, Carbon::now()->addDays(7), function () use($page){
      return Page::find($page);
    });

    return $banners;
  }

  public function getCacheKey($key)
  {
    return self::CACHE_KEY . ".$key";
  }

}