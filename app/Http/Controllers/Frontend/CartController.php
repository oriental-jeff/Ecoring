<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Logistics;
use App\Model\Orders;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $pages = Pages::get(5);
        $carts = Cart::where('users_id', 1)->get();
        return view('frontend.cart.index', compact(['carts', 'pages']));
    }

    public function order(Request $request)
    {
        foreach ($request->cartID as $k => $v) {
            $c = Cart::find($v);
            $c->quantity = $request->quantity[$k];
            $c->update();
        }
        $cart = Cart::whereIn('id', $request->cartID)->stockCheckAvailable(config('global.warehouse'))->get();
        if (COUNT($cart) == 0) {
            $pages = Pages::get(5);
            $carts = Cart::whereIn('id', $request->cartID)->get();
            $logistics = Logistics::onlyActive()->get();

            $delivery_addr = $logistics;

            return view('frontend.cart.order', compact(['carts', 'pages', 'logistics', 'delivery_addr']));
        } else {
            return back();
        }
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
