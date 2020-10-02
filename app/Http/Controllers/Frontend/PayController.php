<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Logistics;
use App\Model\Orders;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{

    public function index(Request $request)
    {
        $pages = Pages::get(5);
        $cart = Cart::whereIn('id', $request->cartID)->stockCheckAvailable(config('global.warehouse'))->get();
        if (COUNT($cart) == 0) {
            $carts = Cart::whereIn('id', $request->cartID)->get();
            $logistic = Logistics::where('id', $request->logistic_id)->onlyActive()->get();

            // Discount

            // Delivery
            $delivery_addr = $logistic;

            return view('frontend.pay.index', compact(['carts', 'pages', 'logistic', 'delivery_addr']));
        } else {
            $carts = Cart::where('users_id', 1)->get();
            return view('frontend.cart.index', compact(['carts', 'pages']));
        }
    }
}
