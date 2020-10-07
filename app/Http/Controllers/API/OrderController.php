<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Orders;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends BaseController
{
    public function checkorder($ordercode)
    {
        $order = Orders::where('code', $ordercode)->count();
        try {
            $success['result'] =  $order;
            return $this->sendResponse($success, 'Count total code in Order');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', $th);
        }
    }
}
