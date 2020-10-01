<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Order;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends BaseController
{
    public function checkorder($ordercode)
    {
        $order = Order::where('code', $ordercode)->count();
        try {
            $success['result'] =  1;
            return $this->sendResponse($success, 'Count total code in Order');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', $th);
        }
    }
}
