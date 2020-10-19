<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\GlobalFn;
use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Logistics;
use App\Model\UserAddressDelivery;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        // $pages = Pages::get();
        $carts = Cart::where('users_id', Auth::user()->id)->whereNull('orders_id')->get();
        return view('frontend.cart.index', compact(['carts']));
    }

    public function order(Request $request)
    {
        // Check Cart
        $cart = Cart::whereIn('id', $request->cartID)->whereNull('orders_id')->where('active', 1);
        $cartCount = clone $cart;
        if ($cartCount->count() == 0) return redirect(route('frontend.cart', ['locale' => get_lang()]));

        // Check lastest time update before update new
        $cartLastest = Cart::where('active', 1)->withoutOrder()->where('users_id', Auth::id())->first();

        $dNow = isset($cartLastest->updated_at) ? $cartLastest->updated_at : null;

        // Clear all old cart set active to 0
        GlobalFn::resetProductOnCart();

        foreach ($request->cartID as $k => $v) {
            $c = Cart::find($v);
            $c->quantity = $request->quantity[$k];
            $c->active = 1;
            $c->updated_at = $dNow ? $dNow : now();
            $c->update();
        }
        // Check Stock
        if ($cart->stockCheckAvailable(config('global.warehouse'))->count() > 0) return redirect(route('frontend.cart', ['locale' => get_lang()]));

        // $pages = Pages::get();
        $carts = Cart::whereIn('id', $request->cartID)->whereNull('orders_id')->get();
        $logistics = Logistics::onlyActive()->get();

        $delivery_addr = UserAddressDelivery::where('user_id', Auth::id())->get();

        return view('frontend.cart.order', compact(['carts', 'logistics', 'delivery_addr']));
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
