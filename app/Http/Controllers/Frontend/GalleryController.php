<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Facades\App\Repository\Banners;
use App\Model\ViewActivityLog;
use App\Model\Application;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
  const MODEL = 'Project';
  public function index($locale='', Request $request)
  {
    $pages = Pages::get(3);
    $banners = Banners::get(3);
    // $applications = Application::onlyActive()->with(['project' => function ($query) {
    //     $query->where('active', 1);
    // }])->orderBy('updated_at', 'desc')->paginate(12);
    $projects = Project::onlyActive();
    if($request->filled('occupation')):
      $projects =  $projects->whereHas('application', function ($query) use ($request){
        $query->where('active', 1)
          ->where('occupation', $request->occupation);
      });
    else:
    endif;
    $projects = $projects->orderBy('recommend', 'desc')->paginate(12);
    $views = get_logs_action(self::MODEL, 'view');

    return view('frontend.gallery.index', compact(['pages', 'banners', 'projects', 'views']));
  }

  public function detail($locate, Project $project, Request $request)
  {
      add_log(self::MODEL, $project->id);
      $pages = Pages::get(3);
      $banners = Banners::get(3);
      $views = get_log_action(self::MODEL, $project->id);

      return view('frontend.gallery.detail', compact(['pages', 'banners', 'project', 'views']));
  }

  public static function getCoverPicture($opt = 'cover', $occupation, $project)
  {
      $rt = '';
      if ($opt === 'cover') {
          // For Cover Picture
          $rt = 'http://via.placeholder.com/350x210';
          switch ($occupation) {
              case 'Faculty':
                  if ($project->image_coverpictureFac1) {
                      $rt = $project->image_coverpictureFac1;
                  } elseif ($project->image_coverpictureFac2) {
                      $rt = $project->image_coverpictureFac2;
                  } elseif ($project->image_coverpictureFac3) {
                      $rt = $project->image_coverpictureFac3;
                  }
                  break;
              case 'Student':
                  $rt = $project->image_coverpictureStu1;
                  break;
              case 'Practitioner':
                  $rt = $project->image_coverpicturePra1;
                  break;
              case 'Honorable':
                  $rt = $project->image_coverpictureHon1;
                  break;
              default:
                  $rt = $rt;
          }
      } elseif ($opt === 'profile') {
          // FOr Profile Picture
          $rt = 'http://via.placeholder.com/80x80';
          switch ($occupation) {
              case 'Faculty':
                  $rt = $project->application->profile_pictureFac;
                  break;
              case 'Student':
                  $rt = $project->application->profile_pictureStu;
                  break;
              case 'Practitioner':
                  $rt = $project->application->profile_picturePra;
                  break;
              case 'Honorable':
                  $rt = $project->application->profile_pictureHon;
                  break;
              default:
                  $rt = $rt;
          }
      } elseif ($opt === 'pdf') {
          // FOr Abstract Form
          switch ($occupation) {
              case 'Faculty':
                  if ($project->image_abstractformFac1) {
                      $rt = $project->image_abstractformFac1;
                  } elseif ($project->image_abstractformFac2) {
                      $rt = $project->image_abstractformFac2;
                  } elseif ($project->image_abstractformFac3) {
                      $rt = $project->image_abstractformFac3;
                  }
                  break;
              case 'Student':
                  $rt = $project->image_abstractformStu1;
                  break;
              case 'Practitioner':
                  $rt = $project->image_abstractformPra1;
                  break;
              case 'Honorable':
                  $rt = $project->image_abstractformHon1;
                  break;
              default:
                  $rt = $rt;
          }
      } elseif ($opt === 'image') {
          // FOr Abstract Form
          $rt = '';
          switch ($occupation) {
              case 'Faculty':
                  if ($project->image_posterFac1) {
                      $rt = $project->image_posterFac1;
                  } elseif ($project->image_posterFac2) {
                      $rt = $project->image_posterFac2;
                  } elseif ($project->image_posterFac3) {
                      $rt = $project->image_posterFac3;
                  }
                  break;
              case 'Student':
                  $rt = $project->image_posterStu1;
                  break;
              case 'Practitioner':
                  $rt = $project->image_posterPra1;
                  break;
              case 'Honorable':
                  $rt = $project->image_posterHon1;
                  break;
              default:
                  $rt = $rt;
          }
      } elseif ($opt === 'video') {
          // FOr Abstract Form
          $rt = '';
          switch ($occupation) {
              case 'Faculty':
                  if ($project->image_motionclipFac1) {
                      $rt = $project->image_motionclipFac1;
                  } elseif ($project->image_motionclipFac2) {
                      $rt = $project->image_motionclipFac2;
                  } elseif ($project->image_motionclipFac3) {
                      $rt = $project->image_motionclipFac3;
                  }
                  break;
              case 'Student':
                  $rt = $project->image_motionclipStu1;
                  break;
              case 'Practitioner':
                  $rt = $project->image_motionclipPra1;
                  break;
              case 'Honorable':
                  $rt = $project->image_motionclipHon1;
                  break;
              default:
                  $rt = $rt;
          }
      }
      return $rt;
  }
}
