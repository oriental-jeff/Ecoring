<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Stocks;
use App\Model\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $pages = Pages::get(5);
        $carts = Cart::where('users_id', 1)->onlyAvailable(config('global.warehouse'))->get();
        return view('frontend.cart.index', compact(['carts', 'pages']));
    }
    public function add(Request $request)
    {
        if ($this->check_login()) :
            $this->restore();
            $request->price = 18000;
            if (!$request->filled('qty')) :
                $request->qty = 1;
            endif;

            $cart = Cart::instance('cart')->add($request->product_id, $request->product_id, $request->qty, $request->price)->associate('App\Model\Cart');;
            Cart::instance('cart')->store(Auth::id());
            $res = ['result' => true, 'message' => 'success'];
            return collect($res)->toJson();
        endif;
    }

    public function cart()
    {
        $product = Cart::where('users_id', Auth::id())->get();
        return view('frontend.cart', compact('product'));
    }

    public function check_login()
    {
        if (Auth::user()) :
            return true;
        endif;
        return false;
    }

    public function update(Request $request)
    {
        if (!empty($request->row_id) && !empty($request->qty) && $this->check_login()) :
            Cart::instance('cart')->update($request->row_id, $request->qty);
            Cart::instance('cart')->store(Auth::id());
            $res = ['result' => true, 'message' => 'success'];
            return collect($res)->toJson();
        endif;
    }

    public function delete(Request $request)
    {
        if ($request->filled('row_id')) :
            Cart::instance('cart')->update($request->row_id, 0);
            Cart::instance('cart')->store(Auth::id());
            $res = ['result' => true, 'message' => 'success'];
            return collect($res)->toJson();
        endif;
    }

    public function destroy()
    {
        if ($this->check_login()) :
            Cart::instance('cart')->destroy();
            Cart::instance('cart')->store(Auth::id());
            $res = ['result' => true, 'message' => 'success'];
            return collect($res)->toJson();
        endif;
    }

    //database shoppingcart to session cart
    public function restore()
    {
        if ($this->check_login()) :
            Cart::instance('cart')->restore(Auth::id());
            $res = ['result' => true, 'message' => 'success'];
            return collect($res)->toJson();
        endif;
    }


    public function check_product_available()
    {
    }
}
