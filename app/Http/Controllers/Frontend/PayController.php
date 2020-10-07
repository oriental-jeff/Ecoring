<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Illuminate\Http\Request;
use App\Model\Orders;
use App\Model\Cart;
use App\Model\Logistics;
use App\Model\UserProfile;
use App\Model\UserAddressDelivery;
use App\Model\BankAccounts;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{

    public function index(Request $request)
    {
        // dd($request);
        // $pages = Pages::get(5);
        $cart = Cart::whereIn('id', $request->cartID)->stockCheckAvailable(config('global.warehouse'))->get();
        if (COUNT($cart) == 0) {
            $carts = Cart::whereIn('id', $request->cartID)->whereNull('orders_id')->get();
            $logistic = Logistics::where('id', $request->logistic_id)->onlyActive()->get();

            // Discount

            // Delivery
            if ($request->delivery_addr == 'profile') { // Profile Delivery Address
                $delivery_addr = UserProfile::where('id', $request->profile_id)->get();
            } else { // Custome Delivery Address
                $delivery_addr = UserAddressDelivery::where('id', $request->custom_id)->get();
            }

            return view('frontend.pay.index', compact(['carts', 'logistic', 'delivery_addr']));
        } else {
            $carts = Cart::where('users_id', Auth::id())->whereNull('orders_id')->get();
            return view('frontend.cart.index', compact(['carts']));
        }
    }

    public function store(Request $request)
    {
        // Check Cart
        $carts = Cart::whereIn('id', $request->cartID)->whereNull('orders_id')->get();
        if (COUNT($carts) == 0) {
            $carts = Cart::where('users_id', Auth::id())->whereNull('orders_id')->get();
            return view('frontend.cart.index', compact(['carts']));
        } else {
            $data = request()->validate([
                "logistics_id" => "required",
                "telephone" => "required",
                "address" => "required",
                "sub_district_id" => "required",
                "district_id" => "required",
                "province_id" => "required",
                "postcode" => "required",
                "vat" => "required",
                "total_amount" => "required",
                "total_weight" => "required",
                "discount" => "required",
                "delivery_charge" => "required",
            ]);

            $cart = Cart::whereIn('id', $request->cartID)->stockCheckAvailable(config('global.warehouse'))->get();
            // dd($cart);

            if (COUNT($cart) == 0) {
                $order_data = [
                    "code" => "UCM" . rand(0, 99999999),
                    "logistics_id" => $data['logistics_id'],
                    "telephone" => $data['telephone'],
                    "address" => $data['address'],
                    "sub_district_id" => $data['sub_district_id'],
                    "district_id" => $data['district_id'],
                    "province_id" => $data['province_id'],
                    "postcode" => $data['postcode'],
                    "vat" => $data['vat'],
                    "total_amount" => $data['total_amount'],
                    "total_weight" => $data['total_weight'],
                    "discount" => $data['discount'],
                    "delivery_charge" => $data['delivery_charge'],
                    "users_id" => Auth::id(),
                    "updated_by" => Auth::id(),
                    "created_by" => Auth::id(),
                ];

                try {
                    // Create Order
                    $od = Orders::create($order_data);

                    $orderResult = ["code" => $od->code, "total_amount" => $data['total_amount']];
                    $bank_accounts = BankAccounts::onlyActive()->get();

                    // Update Cart
                    foreach ($request->cartID as $k => $v) {
                        $c = Cart::find($v);
                        $c->orders_id = $od->id;
                        $c->amount = $request->productPrice[$k];
                        $c->update();
                    }

                    return view('frontend.pay.success', compact(['orderResult', 'bank_accounts']));
                } catch (\Throwable $th) {
                    $carts = Cart::where('users_id', Auth::id())->whereNull('orders_id')->get();
                    return view('frontend.cart.index', compact(['carts']));
                }
            } else {
                $carts = Cart::where('users_id', Auth::id())->whereNull('orders_id')->get();
                return view('frontend.cart.index', compact(['carts']));
            }
        }
    }
}
