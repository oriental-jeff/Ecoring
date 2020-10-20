<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class GlobalFn
{
    public static function getCountProductOnCart($productID)
    {
        $n = \App\Model\Cart::where('products_id', $productID)->withoutOrder()->where('users_id', '!=', Auth::id())->count();
        return $n;
    }
    public static function productReservedOnCart($productID)
    {
        $rs = \App\Model\Cart::where('products_id', $productID)->where('active', 1)->withoutOrder()->where('users_id', '!=', Auth::id())->count();
        return $rs > 0 ? true : false;
    }
    public static function productOutOfStock($productID)
    {
        $rs = \App\Model\Products::where('id', $productID)->onlyAvailable(config('global.warehouse'))->count();
        return $rs == 0 ? true : false;
    }
    public static function getCountdown()
    {
        // Check priority is cart and order
        $nCD = \App\Model\Cart::where('active', 1)->withoutOrder()->where('users_id', Auth::id())->get();
        $type = 'cart';
        if (COUNT($nCD) == 0) {
            $nCD = \App\Model\Orders::where('users_id', Auth::id())->onlyNotPay()->orderBy('id', 'desc')->get();
            $type = 'order';
        }
        return [$nCD, $type];
    }
    public static function resetProductOnCart()
    {
        \App\Model\Cart::where('active', 1)->withoutOrder()->where('users_id', Auth::id())->update(['active' => 0]);
        return true;
    }
}
