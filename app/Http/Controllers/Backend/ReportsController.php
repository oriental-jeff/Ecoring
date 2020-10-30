<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illminate\Support\Facades\Auth;

use App\model\StatusConfig;
use App\model\Orders;
class ReportsController extends Controller
{
    const MODULE = 'reports';

    public function index() {
        return redirect(route('backend.reports.orders'));
    }

    public function orders(Request $request) {
        // $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword') or $request->filled('status')) :
            $orders = Orders::getDataByKeyword($request)->get();
        else :
            $orders = Orders::limit(50)->orderBy('created_at', 'desc')->get();
        endif;

        $status = StatusConfig::where('type', 'order')->get();

        return view('backend.reports.orders', compact(['orders', 'status']));
    }
}
