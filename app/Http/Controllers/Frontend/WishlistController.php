<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Cart;
use App\Model\Product;

class WishlistController extends Controller
{
  public function add(Request $request) {
    if($this->check_login()):
      $this->restore();
      $product_id = $request->product_id;
      $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($product_id) {
            return $cartItem->id === $product_id;
        });
      if ($duplicates->isEmpty()) :
        $cart = Cart::instance('wishlist')->add($request->product_id, $request->product_id, 1, 1)->associate('App\Model\Product');
        Cart::instance('wishlist')->store(Auth::id()); 
      endif;
    
      $res = ['result' => true, 'message' => 'success'];
      return collect($res)->toJson();
    endif;
  }

  public function wishlist() {
    $product = Product::onlyActive()->get();
     return view('frontend.wishlist', compact('product'));
  }

  public function check_login() {
    if(Auth::user()) :
      return true;
    endif;
    return false;
  }

  public function delete(Request $request) {
    if($request->filled('row_id')) :
      Cart::instance('wishlist')->update($request->row_id, 0);
      Cart::instance('wishlist')->store(Auth::id()); 
      $res = ['result' => true, 'message' => 'success'];
      return collect($res)->toJson();
    endif;
  }

  public function destroy() {
    if($this->check_login()):
      Cart::instance('wishlist')->destroy();
      Cart::instance('wishlist')->store(Auth::id()); 
      $res = ['result' => true, 'message' => 'success'];
      return collect($res)->toJson();
    endif;
  }

  //database shoppingcart to session cart
  public function restore(){
    if($this->check_login()):
      Cart::instance('wishlist')->restore(Auth::id()); 
      $res = ['result' => true, 'message' => 'success'];
      return collect($res)->toJson();
    endif;
  }
}
