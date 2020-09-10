<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Banner;
use App\Model\Department;
use App\Model\Activity;
use App\Model\News;
use App\Model\HallOfFame;
use App\Model\WebInfo;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;




class HomeController extends Controller
{


    public function index()
    {
      $data = [
      'banners'       => Banner::with('banners_detail')->where('page_id', 1)->get(),
      'departments'   => Department::with('departments_detail')->departmentActive()->get(),
      'Activities'    => Activity::activitiesActive()->orderBy('id','DESC')->get(),
      'News'          => News::activitiesActive()->orderBy('id','DESC')->get(),
      'hall_of_fames' => HallOfFame::with('students')->onlyActive()->orderBy('id','DESC')->limit(3)->get(),
      'webinfo'       => WebInfo::find(1)->first(),
      ];
    
        return view('frontend.home.index', compact(['data']));
    }
}
