<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illminate\Support\Facades\Auth;
use Carbon\Carbon;

// Models
use App\model\StatusConfig;
use App\model\Orders;

class ReportsController extends Controller
{
    const MODULE = 'reports';

    // public function index() {
    //     return redirect(route('backend.reports.orders'));
    // }

    // V I E W & P R O C E S S
    public function orders(Request $request) {
        // $this->authorize(mapPermission(self::MODULE));

        // GET : Status Config
        $status = StatusConfig::where('type', 'order')->get();

        // GET : Orders
        if ($request->has('_token')) :
            $orders = Orders::reportGetSearchData($request)->get();
        else :
            $orders = Orders::limit(50)->orderBy('created_at', 'desc')->get();
        endif;

        // Preparing Data
        foreach ($orders as $key => $item) :
            $list[$key]['date_order'] = Carbon::parse($item->created_at)->isoFormat('DD-MM-YYYY @ HH:mm:ss');
            $list[$key]['code'] = $item->code;
            $list[$key]['status'] = $item->status_config->name_th;
            $list[$key]['payment_name'] = $item->payment_type;
            $list[$key]['total_amount'] = $item->total_amount;
            $list[$key]['vat'] = $item->vat;
            $list[$key]['delivery_charge'] = $item->delivery_charge;
            $list[$key]['pickup'] = $item->pickup_optional_name;
            $list[$key]['logistic_image'] = $item->logistic->image;
            $list[$key]['logistic_name'] = $item->logistic->name_th;
            // $list[$key][''] = $item->;
            // $list[$key][''] = $item->;
            // $list[$key][''] = $item->;
            // $list[$key][''] = $item->;
            // $list[$key][''] = $item->;
            // $list[$key][''] = $item->;
        endforeach;

        // dd($list);

        return view('backend.reports.orders', compact(['orders', 'status']));
    }

    // P R I V A T E
    // Not Used
    private function _process_serach_orders($request) {
        if ($request->has('from')) :
            $orders = Orders::reportOrdersGetSearchData($request)->get();
        else :
            echo 'Not Date';
        endif;

        dd($orders);
    }
}
