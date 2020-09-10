<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Facades\App\Repository\Banners;
use App\Model\AboutUs;
use App\Model\Application;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class HomeController extends Controller
{
  const MODEL = 'Project';
  public function index()
  {
    $pages = Pages::get(1);
    $banners = Banners::get(1);
    $aboutus = AboutUs::find(1);
    // $applications = Application::onlyActive()->with(['project' => function ($query) {
    //   $query->where('active', 1);
    // }])->orderBy('updated_at', 'desc')->paginate(12);
    $projects = Project::onlyActive()->inRandomOrder()->limit(12)->get();
    $views = get_logs_action(self::MODEL, 'view');

    return view('frontend.home.index', compact(['pages', 'banners', 'aboutus', 'projects', 'views']));
  }

  public function searchPage(Request $request)
  {
    $pages = Pages::get(1);
    $search = $request->q;
    return view('frontend.home.search-page', compact(['pages', 'search']));
  }

}

