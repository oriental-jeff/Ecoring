<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Province;
use App\Model\District;
use App\Model\SubDistrict;
use App\Model\Favorites;
use App\Model\Cart;
use App\Model\Products;
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
    /*
    condition
    0 : สินค้าหมด
    1 : หยิบลงตะกร้าได้
    2 : จำนวนสินค้าในตะกร้าเกินกว่าที่มีในสต๊อก
    */
    if (Auth::check()):
      $product = Products::where('id', $request->product_id)->first();
      $quantity_remain = $product->stocks[0]->quantity;
      $cart_item = 0;
      if ($quantity_remain > 0):
        $amount = $product->product_price;
        $cart = Cart::where('users_id', Auth::id());
        $cart_item = $cart->count();
        $cart = $cart->where('products_id', $request->product_id)->withoutOrder()->first();
        if (!empty($cart)):
          $quantity_plus = $cart->amount + $request->quantity;
          if ($quantity_plus <= $quantity_remain):
            Cart::where('id', $cart->id)->increment('quantity', $request->quantity);
            $condition = 1;
          else:
            $condition = 2;
          endif;
        else:
          $data = [
            'users_id' => Auth::id(),
            'products_id' => $request->product_id,
            'quantity' => $request->quantity,
            'amount' => $amount,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
          ];
          Cart::create($data);
          $cart_item = Cart::where('users_id', Auth::id())->count();
          $condition = 1;
        endif;
      else:
        $conditon = 0;
      endif;

      switch ($condition):
        case 0:
          $msg = __('messages.out_of_stock');
          break;
        case 1:
          $msg = __('messages.add_basket_success');
          break;
        case 2:
          $msg = __('messages.not_enought_product');
          break;
        default:
          $msg = __('messages.add_basket_success');
          break;
      endswitch;

      return response()->json([
        'condition' => $condition,
        'cart_item' => $cart_item,
        'msg' => $msg,
      ]);
    else:
      return false;
    endif;
  }
}