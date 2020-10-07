<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Province;
use App\Model\District;
use App\Model\SubDistrict;
use App\Model\Favorites;
use App\Model\Cart;
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

  public function change_favorite(Request $request)
  {
    if (Auth::check()):
      if ($request->favorite == '0'):
        $data = [
          'user_id' => Auth::id(),
          'products_id' => $request->product_id,
          'created_by' => Auth::id(),
          'updated_by' => Auth::id(),
        ];
        $favorite = Favorites::create($data);
      else:
        $favorite = Favorites::where('user_id', Auth::id())->where('products_id', $request->product_id)->delete();
      endif;
      return true;
    else:
      return route('frontend.auth.login.form', ['locale' => get_lang()]);
    endif;
  }

  public function add_cart(Request $request)
  {
    if (Auth::check()):
      $data = [
        'users_id' => Auth::id(),
        'products_id' => $request->product_id,
        'quantity' => $request->quantity,
        'amount' => $request->amount,
        'created_by' => Auth::id(),
        'updated_by' => Auth::id(),
      ];
      Cart::create($data);
      return true;
    else:
      return false;
    endif;
  }
}
