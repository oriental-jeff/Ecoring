<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\ProductPrices;
use App\Model\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class ProductPricesController extends Controller
{
    const MODULE = 'product_prices';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $product_prices = ProductPrices::getDataByKeyword($request->keyword)->get();
        else :
            $product_prices = ProductPrices::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;
        return view('backend.product_prices.index', compact('product_prices'));
    }

    public function create(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $product_price = new ProductPrices;
        $products = Products::onlyActive()->get();

        return view('backend.product_prices.create', compact(['product_price', 'products']));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $promotion = ProductPrices::create($this->validateRequest());

        return redirect(route('backend.product_prices.index'));
    }

    public function edit(ProductPrices $product_price)
    {
        $this->authorize(mapPermission(self::MODULE));
        $products = Products::onlyActive()->get();

        return view('backend.product_prices.update', compact(['product_price', 'products']));
    }

    public function update(Request $request, ProductPrices $product_price)
    {
        $this->authorize(mapPermission(self::MODULE));
        $product_price->update($this->validateRequest());

        return redirect(route('backend.product_prices.index'));
    }

    public function destroy(ProductPrices $product_prices)
    {
        $this->authorize(mapPermission(self::MODULE));
        $product_prices->delete();
        return redirect(route('backend.product_prices.index'));
    }

    private function validateRequest()
    {
        if (request()->route()->getActionMethod() == 'store') :
            $validatedData = request()->validate([
                "products_id"   => "required",
                "price"   => "required",
                "start_at"   => "required",
            ]);
        else :
            $validatedData = request()->validate([
                "products_id"   => "",
                "price"   => "required",
                "start_at"   => "required",
            ]);
        endif;

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;


        return $validatedData;
    }
}
