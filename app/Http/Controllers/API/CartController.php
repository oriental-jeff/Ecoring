<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Cart;
use Illuminate\Support\Facades\Auth;
use Validator;

class CartController extends BaseController
{

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
}
