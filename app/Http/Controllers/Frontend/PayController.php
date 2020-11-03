<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Model\Orders;
use App\Model\Cart;
use App\Model\Stocks;
use App\Model\Logistics;
use App\Model\UserProfile;
use App\Model\UserAddressDelivery;
use App\Model\BankAccounts;
use App\Model\Branch;
use App\Model\WebInfo;

use App\Helpers\AutoGenDoc as GenCode;
use App\Helpers\SendPdfMail as PdfMail;
use PDF;

class PayController extends Controller
{

    public function index(Request $request)
    {
        // Check Cart
        $cart = Cart::whereIn('id', $request->cartID)->whereNull('orders_id')->where('active', 1);
        $cartCount = clone $cart;
        if ($cartCount->count() == 0) return redirect(route('frontend.cart', ['locale' => get_lang()]));

        // Check Stock
        if ($cart->stockCheckAvailable(config('global.warehouse'))->count() > 0) return redirect(route('frontend.cart', ['locale' => get_lang()]));

        $carts = Cart::whereIn('id', $request->cartID)->whereNull('orders_id')->get();

        // Delivery
        $pickup_optional = $request->pickup_optional;
        $logistic = Logistics::where('id', $request->logistic_id)->onlyActive()->get();
        if ($request->delivery_addr == 'profile') { // Profile Delivery Address
            $delivery_addr = UserProfile::where('id', $request->profile_id)->get();
        } else { // Custome Delivery Address
            $delivery_addr = UserAddressDelivery::where('id', $request->custom_id)->get();
        }
        $branch = Branch::where('id', $request->branch)->onlyActive()->get();

        return view('frontend.pay.index', compact(['carts', 'logistic', 'delivery_addr', 'branch', 'pickup_optional']));
    }

    public function store(Request $request)
    {
        // Check Cart
        $cart = Cart::whereIn('id', $request->cartID)->whereNull('orders_id')->where('active', 1);
        $cartCount = clone $cart;
        if ($cartCount->count() == 0) return redirect(route('frontend.cart', ['locale' => get_lang()]));

        // Check Stock
        if ($cart->stockCheckAvailable(config('global.warehouse'))->count() > 0) return redirect(route('frontend.cart', ['locale' => get_lang()]));

        $data = request()->validate([
            "logistics_id" => "required",
            "telephone" => "required",
            "fullname" => "required",
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

        // 1 : Credit Card, 0 : Tranfer Bank
        $payment_type = $request->paymentMethod == 'dccard' ? 1 : 0;

        // Generate Code
        $ord_code = GenCode::generateCode('order');
        $inv_code = GenCode::generateCode('invoice');
        $rcpt_code = $payment_type == 1 ? GenCode::generateCode('receipt') : NULL;

        $order_data = [
            "code" => $ord_code,
            "payment_type" => $payment_type,
            "pickup_optional" => $request->pickup_optional,
            "logistics_id" => $data['logistics_id'],
            "telephone" => $data['telephone'],
            "fullname" => $data['fullname'],
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
            'inv_number' => $inv_code,
            'rcpt_number' => $rcpt_code,
            "users_id" => Auth::id(),
            "updated_by" => Auth::id(),
            "created_by" => Auth::id(),
        ];

        try {
            // Create Order
            $od = Orders::create($order_data);

            $orderResult = ["code" => $od->code, "total_amount" => $data['total_amount'] + $data['delivery_charge'] + $data['vat']];
            $bank_accounts = BankAccounts::onlyActive()->get();

            // Update
            foreach ($request->cartID as $k => $v) :
                // Cart
                $c = Cart::find($v);

                // Stock
                $s = Stocks::where('products_id', $c->products_id)->where('warehouses_id', config('global.warehouse'))->get()[0];
                $s->quantity = $s->quantity - $c->quantity;
                $s->updated_by = Auth::id();
                $s->update();

                // Cart
                $c->orders_id = $od->id;
                $c->amount_full = $request->productPriceFull[$k];
                $c->amount = $request->productPrice[$k];
                $c->update();
            endforeach;

            // Send Mail
            PdfMail::send($payment_type, $od->id);

            return view('frontend.pay.success', compact(['orderResult', 'bank_accounts']));
        } catch (\Throwable $th) {
            return redirect(route('frontend.cart', ['locale' => get_lang()]));
        }
    }
}
