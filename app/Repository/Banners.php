<?php

namespace App\Repository;

use App\Model\Banner;
use Carbon\Carbon;

class Banners {

  CONST CACHE_KEY = 'banners';

  public function get($page)
  {
    $key = "get.{$page}";
    $cacheKey = $this->getCacheKey($key);
    // cache()->forget($cacheKey);

    $banners = cache()->remember($cacheKey, Carbon::now()->addDays(7), function () use($page) {
      return Banner::with(['banners_detail' => function($qry) {
          $qry->orderBy('slide_position', 'ASC');
      }])->where('page_id', $page)->get();
    });

    return $banners;
  }

  public function getCacheKey($key)
  {
    return self::CACHE_KEY . ".$key";
  }

}
