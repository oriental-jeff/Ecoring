<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Orders;
use App\Model\Warehouses;
use App\Model\Products;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    const MODULE = 'orders';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $orders = Orders::getDataByKeyword($request)->get();
        else :
            $orders = Orders::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.orders.index', compact('orders'));
    }

    public function edit(Orders $order)
    {
        $this->authorize(mapPermission(self::MODULE));
        $warehouses = Warehouses::all();
        $products = Products::onlyActive()->get();

        return view('backend.orders.update', compact(['order', 'warehouses', 'products']));
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

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "warehouses_id" => "required",
            "products_id" => "required",
            "quantity" => "required",
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
