<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Facades\App\Repository\Banners;
use App\Model\AboutUs;
use App\Model\Products;
use App\Model\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  const MODEL = 'product';
  public function index()
  {
    $pages = Pages::get(1);
    $banners = Banners::get(1);
    $aboutus = AboutUs::find(1);
    $new_products = Products::onlyActive()->withCount('favorites')->orderBy('created_at', 'desc')->limit(12)->get();
    $categories = Categories::get();
    $recommended_products = Products::onlyActive()->withCount('favorites')->inRandomOrder()->limit(48)->get();
    // $applications = Application::onlyActive()->with(['project' => function ($query) {
    //   $query->where('active', 1);
    // }])->orderBy('updated_at', 'desc')->paginate(12);
    $views = get_logs_action(self::MODEL, 'view');

    return view('frontend.home.index', compact(['pages', 'banners', 'aboutus', 'new_products', 'categories', 'recommended_products', 'views']));
  }

  public function searchPage(Request $request)
  {
    $pages = Pages::get(1);
    $search = $request->q;
    return view('frontend.home.search-page', compact(['pages', 'search']));
  }

}

