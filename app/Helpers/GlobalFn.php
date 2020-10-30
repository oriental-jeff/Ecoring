<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class GlobalFn
{
    public static function productFavoriteUpdate($productID, $onlyMe=true)
    {
        $fvr = \App\Model\Favorites::where('products_id', $productID);
        if ($onlyMe) $fvr = $fvr->where('user_id', Auth::id());
        $fvr->update(['products_updated' => \App\Model\Products::where('id', $productID)->pluck('products_updated')[0] ?? null]);
    }
    public static function getProductFavoriteUpdate($count=true)
    {
        $n = \App\Model\Products::leftJoin('favorites', function($join) {
                $join->on('products.id', '=', 'favorites.products_id');
            })
            ->where('favorites.user_id', '=', Auth::id())
            ->where('products.active', 1)->onlyAvailable(config('global.warehouse'))
            ->whereRaw('favorites.products_updated != products.products_updated');
        return $count ? $n->count() : $n->get();
    }
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
            $nCD = \App\Model\Orders::where('users_id', Auth::id())->onlyNotPay()->orderBy('id', 'asc')->get();
            $type = 'order';
        }
        return [$nCD, $type];
    }
    public static function resetProductOnCart()
    {
        // Reset favorite notification
        $cDel = \App\Model\Cart::where('active', 1)->withoutOrder()->where('users_id', Auth::id());
        $c = clone $cDel;

        foreach ($c->get() as $k => $v) {
            // update updated_at of product for make favorite notification
            $pd = \App\Model\Products::find($v->products_id);
            $pd->update(['products_updated' => now()->toDateTimeString()]);

            // notification this user id
            GlobalFn::productFavoriteUpdate($v->products_id);
        }

        $cDel->update(['active' => 0]);
        return true;
    }
}
