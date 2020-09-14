<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Stocks;
use App\Model\Warehouses;
use App\Model\Products;
use Illuminate\Support\Facades\Auth;

class StocksController extends Controller
{
    const MODULE = 'stocks';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $stocks = Stocks::getDataByKeyword($request)->get();
        else :
            $stocks = Stocks::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.stocks.index', compact('stocks'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $stock = new Stocks;
        $warehouses = Warehouses::all();
        $products = Products::onlyActive()->get();

        return view('backend.stocks.create', compact(['stock', 'warehouses', 'products']));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        try {
            Stocks::create($this->validateRequest());
            return redirect(route('backend.stocks.index'));
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect(route('backend.stocks.create'))->with('status', 'มีข้อมูลนี้แล้ว โปรดลองใหม่!');
        }
    }

    public function edit(Stocks $stock)
    {
        $this->authorize(mapPermission(self::MODULE));
        $warehouses = Warehouses::all();
        $products = Products::onlyActive()->get();

        return view('backend.stocks.update', compact(['stock', 'warehouses', 'products']));
    }

    public function update(Request $request, Stocks $stock)
    {
        $this->authorize(mapPermission(self::MODULE));
        $stock->update($this->validateRequest());

        return redirect(route('backend.stocks.index'));
    }

    public function destroy(Stocks $stock)
    {
        $this->authorize(mapPermission(self::MODULE));
        $stock->delete();

        return redirect(route('backend.stocks.index'));
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
