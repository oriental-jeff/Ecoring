<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Facades\App\Repository\Banners;
use App\Model\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AboutController extends Controller
{
  public function index()
  {
    $pages = Pages::get(2);
    $banners = Banners::get(2);
    $aboutus = AboutUs::find(1);

    return view('frontend.about.index', compact(['pages', 'banners', 'aboutus']));
  }

}

