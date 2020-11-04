<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Orders;
use App\Model\Warehouses;
use App\Model\Products;
use App\Model\StatusConfig;
use App\Helpers\CustomSendMailWithPdf as CMP;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    const MODULE = 'orders';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword') or $request->filled('status')) :
            $orders = Orders::getDataByKeyword($request)->get();
        else :
            $orders = Orders::limit(50)->orderBy('created_at', 'desc')->get();
        endif;

        $status = StatusConfig::where('type', 'order')->get();

        return view('backend.orders.index', compact(['orders', 'status']));
    }

    public function edit(Orders $order)
    {
        $this->authorize(mapPermission(self::MODULE));
        $order = Orders::where('id', $order->id)->get();
        $status = StatusConfig::where('type', 'order')->get();

        return view('backend.orders.update', compact(['order', 'status']));
    }

    public function update(Request $request, Orders $order)
    {
        $this->authorize(mapPermission(self::MODULE));
        $order->update($this->validateRequest());

        return redirect(route('backend.orders.index'));
    }

    public function destroy(Orders $order)
    {
        $this->authorize(mapPermission(self::MODULE));
        $order->delete();

        return redirect(route('backend.orders.index'));
    }

    // ----------------------------------------------------------------------------------------------
    // Private
    private function validateRequest()
    {
        $validatedData = request()->validate([
            "status" => "required",
            "tracking_no" => "",
        ]);

        $validatedData['updated_by'] = Auth::id();

        return $validatedData;
    }

    // SPECIFIC
    public function send_mail_invoice(Request $request) {
        $result = CMP::send_invoice($request->order_id);

        if ($result->getData()->message->statuscode == 1) :
            $sendback = ['result' => true, 'message' => $result->getData()->message->statusdesc];
        else :
            $sendback = ['result' => false, 'message' => $result->getData()->message->statusdesc];
        endif;

        return response()->json($sendback);
    }

    public function send_mail_receipt(Request $request) {
        $result = CMP::send_receipt($request->order_id);

        if ($result->getData()->message->statuscode == 1) :
            $sendback = ['result' => true, 'message' => $result->getData()->message->statusdesc];
        else :
            $sendback = ['result' => false, 'message' => $result->getData()->message->statusdesc];
        endif;

        return response()->json($sendback);
    }
}
