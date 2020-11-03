<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Products;
use App\Model\Stocks;
use App\Model\Warehouses;
use App\Model\Categories;
use App\Model\Grades;
use App\Model\Tags;
use App\Model\ProductTags;
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
        $tags = Tags::all();

        return view('backend.products.create', compact(['product', 'warehouses', 'categories', 'grades', 'tags']));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));

        DB::transaction(function () use ($request) {
          $product = Products::create($this->validateRequest());
          $product->storeImage();

          // Stock
          if ($product && $request->warehouses_id) {
              $stockDataArray = [
                  'products_id' => $product->id,
                  'warehouses_id' => $request->warehouses_id,
                  'quantity' => 1
              ];
              Stocks::create($this->validateRequestStock($stockDataArray));
          }

          // Tags
          if ($request->tags_id) {
              foreach ($request->tags_id as $key => $tag) :
                  $detail = [
                      'products_id' => $product->id,
                      'tags_id'  => $tag,
                  ];
                  $detail['updated_by'] = Auth::id();
                  $detail['created_by'] = Auth::id();
                  ProductTags::create($detail);
              endforeach;
          }

          foreach ($request->input('image_detail', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image_detail');
          }

          deleteImageTmp();
        });

        return redirect(route('backend.products.index'));
    }

    public function edit(Products $product)
    {
        $this->authorize(mapPermission(self::MODULE));

        $categories = Categories::all();
        $grades = Grades::all();
        $tags = Tags::all();
        $product_tags = ProductTags::where('products_id', $product->id)->get();
        // dd($product_tags);

        return view('backend.products.update', compact(['product', 'categories', 'grades', 'tags', 'product_tags']));
    }

    public function update(Request $request, Products $product)
    {
      $this->authorize(mapPermission(self::MODULE));
      $product->update($this->validateRequest());
      $product->storeImage();

      // Tag
      $product_tags = ProductTags::selectRaw('tags_id')->where('products_id', $product->id)->pluck('tags_id')->toArray();
      // Delete Case
      if ($request->tags_id) { // if null delete all
        foreach ($product_tags as $tag) :
          if (!in_array($tag, $request->tags_id)) {
            ProductTags::where('products_id', $product->id)
            ->where('tags_id', $tag)
            ->delete();
          }
        endforeach;
        // Create Case
        foreach ($request->tags_id as $tag) :
          if (!in_array($tag, $product_tags)) {
            $dt = [
              'products_id' => $product->id,
              'tags_id'  => $tag,
            ];
            $dt['updated_by'] = Auth::id();
            ProductTags::create($dt);
          }
        endforeach;
      } else {
        if ($product_tags)
          ProductTags::where('products_id', $product->id)
        ->delete();
      }

      if (collect($product->image_detail)->count() > 0) {
        foreach ($product->image_detail as $media) {
          if (!in_array($media->file_name, $request->input('image_detail', []))) {
            $media->delete();
          }
        }
      }

      $media = $product->image_detail->pluck('file_name')->toArray();

      foreach ($request->input('image_detail', []) as $file) {
        if (count($media) === 0 || !in_array($file, $media)) {
          $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image_detail');
        }
      }
      deleteImageTmp();

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
            "code" => "",
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
