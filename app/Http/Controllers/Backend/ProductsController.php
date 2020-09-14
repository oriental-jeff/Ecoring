<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Products;
use App\Model\Stocks;
use App\Model\Warehouses;
use App\Model\Categories;
use App\Model\Grades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    const MODULE = 'products';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword') or $request->filled('active') or $request->filled('recommend')) :
            $products = Products::getDataByKeyword($request)->get();
        else :
            $products = Products::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $product = new Products;
        $warehouses = Warehouses::all();
        $categories = Categories::all();
        $grades = Grades::all();

        return view('backend.products.create', compact(['product', 'warehouses', 'categories', 'grades']));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));

        DB::transaction(function () use ($request) {
            $product = Products::create($this->validateRequest());
            $product->storeImage();

            // Create Stock
            if ($product && $request->warehouses_id) {
                $stockDataArray = [
                    'products_id' => $product->id,
                    'warehouses_id' => $request->warehouses_id,
                    'quantity' => 1
                ];
                Stocks::create($this->validateRequestStock($stockDataArray));
            }
        });

        return redirect(route('backend.products.index'));
    }

    public function edit(Products $product)
    {
        $this->authorize(mapPermission(self::MODULE));

        $categories = Categories::all();
        $grades = Grades::all();

        return view('backend.products.update', compact(['product', 'categories', 'grades']));
    }

    public function update(Request $request, Products $product)
    {
        $this->authorize(mapPermission(self::MODULE));
        $product->update($this->validateRequest());
        $product->storeImage();

        return redirect(route('backend.products.index'));
    }

    public function destroy(Products $product)
    {
        $this->authorize(mapPermission(self::MODULE));
        $product->delete();

        return redirect(route('backend.products.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "categories_id" => "required",
            "grades_id" => "required",
            "sku" => "",
            "name_th" => "required",
            "name_en" => "required",
            "description_th" => "",
            "description_en" => "",
            "info_th" => "",
            "info_en" => "",
            "full_price" => "required",
            "price" => "required",
            "weight" => "required",
            "recommend" => "",
            "active" => "required",
        ]);

        request()->validate([
            "image"  => ['sometimes', 'file', 'image', 'max:200'],
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        // Checkbox
        $validatedData['recommend'] = request()->has('recommend') ? 1 : 0 ?? 0;

        return $validatedData;
    }

    private function validateRequestStock($validatedData)
    {

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
