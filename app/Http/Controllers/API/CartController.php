<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Cart;
use Illuminate\Support\Facades\Auth;
use Validator;

class CartController extends BaseController
{
    public function count(Request $request)
    {
        $carts = Cart::where('users_id', 1)->whereNull('orders_id')->onlyAvailable(config('global.warehouse'))->count();
        try {
            $success['result'] =  $carts;
            return $this->sendResponse($success, 'Count total quantity in Cart');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', $th);
        }
    }

    public function delete(int $cartId)
    {
        try {
            $cart = Cart::findOrFail($cartId);
            // $cart->delete();
        } catch (\Throwable $th) {
            return $this->sendError('Error.', $th);
        }

        $success['cartId'] =  $cartId;

        return $this->sendResponse($success, 'Successfully deleted.');
    }

    public function updateUnit(Request $request)
    {
        try {
        } catch (\Throwable $th) {
            return $this->sendError('Error.', $th);
        }
    }

    public function checkStocks(Request $request)
    {
        // dd($request->orderList[1]['unit']);
        $errCount = 0;
        $cid = [];
        foreach ($request->orderList as $k => $v) {
            $c = Cart::find($v['id']);
            $c->quantity = $v['qty'];
            $c->update();

            $cid[] = $v['id'];
        }
        $cart = Cart::whereIn('id', $cid)->stockCheckAvailable(config('global.warehouse'))->get();
        try {
            $success['result'] =  $cart;
            return $this->sendResponse($success, 'Ok');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', $th);
        }
    }
}
