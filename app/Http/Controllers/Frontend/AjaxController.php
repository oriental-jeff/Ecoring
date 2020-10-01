<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Province;
use App\Model\District;
use App\Model\SubDistrict;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
  public function get_district_list(Request $request)
  {
    if (get_lang() == 'th'):
      $name = 'name_th';
    else:
      $name = 'name_en';
    endif;
    $districts = District::where('province_id', $request->province)->select('id', $name . ' as name')->orderBy($name, 'asc')->get()->toArray();
    
    return response()->json(array('districts' => $districts));
  }

  public function get_sub_district_list(Request $request)
  {
    if (get_lang() == 'th'):
      $name = 'name_th';
    else:
      $name = 'name_en';
    endif;
    $sub_districts = SubDistrict::where('district_id', $request->district)->select('id', $name . ' as name', 'zip_code')->orderBy($name, 'asc')->get()->toArray();

    return response()->json(array('sub_districts' => $sub_districts));
  }
}
