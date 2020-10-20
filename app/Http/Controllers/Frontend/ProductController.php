<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use Facades\App\Repository\Banners;
use App\Model\Products;
use App\Model\Stocks;
use App\Model\Categories;
use App\Model\Grades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductController extends Controller
{
  const MODEL = 'product';
  const warehouse = 2; //ecommerce

  public function index(Request $request)
  {
    $pages = Pages::get(2);
    $banners = Banners::get(2);
    $categories = Categories::withCount(['products' => function ($query) {
      $query->where('active', 1)->onlyAvailable(config('global.warehouse'));
    }])->orderBy('id', 'asc')->get();
    $grades = Grades::withCount(['products' => function ($query) {
      $query->where('active', 1)->onlyAvailable(config('global.warehouse'));
    }])->orderBy('id', 'asc')->get();

    // $min_price = Products::min('full_price');
    $min_price = 0;
    if (empty($min_price)):
      $min_price = 0;
    endif;
    $min_price_selected = $min_price;

    $max_price = Products::max('full_price');
    if (empty($max_price)):
      $max_price = 15000;
    endif;
    $max_price_selected = $max_price;

    $products = Products::onlyActive()->withCount('favorites');
    if ($request->filled('keyword')):
      $request->active = 1;
      $request->recommend = '';
      $products = $products->getDataByKeyword($request);
    endif;

    if ($request->filled('category_id')):
      $request->category_selected = (array) $request->category_id;
      $products = $products->getDataByCategory($request->category_selected);
    endif;

    if ($request->filled('category_selected')):
      $products = $products->getDataByCategory($request->category_selected);
    endif;

    if ($request->filled('grade_selected')):
      $products = $products->getDataByGrade($request->grade_selected);
    endif;

    if ($request->filled('min_price') or $request->filled('max_price')):
      $products = $products->getDataByPriceLength($request);
      $min_price_selected = $request->min_price;
      $max_price_selected = $request->max_price;
    endif;

    if ($request->filled('sort')):
      if ($request->sort == 1): //สินค้าแนะนำ
        $products = $products->orderBy('recommend', 'desc');
      elseif ($request->sort == 2): //สินค้ามาใหม่
        $products = $products->orderBy('created_at', 'desc');
      elseif ($request->sort == 3): // เกรดสินค้า A > D
        $products = $products->orderBy('grades_id', 'asc');
      elseif ($request->sort == 4): // เกรดสินค้า D > A
        $products = $products->orderBy('grades_id', 'desc');
      elseif ($request->sort == 5): // ราคาน้อย > มาก
        $products = $products->orderBy('price', 'asc');
      elseif ($request->sort == 6): // ราคามาก > น้อย
        $products = $products->orderBy('price', 'desc');
      else:
        $products = $products->orderBy('updated_at', 'desc');
      endif;
    endif;
    $products = $products->paginate(config('global.pagination'));

    return view('frontend.product.index', compact(['pages', 'banners', 'categories', 'grades', 'min_price', 'max_price', 'min_price_selected', 'max_price_selected', 'products']));
  }

  public function detail($locate, Products $product, Request $request)
  {
    add_log(self::MODEL, $product->id);
    $pages = Pages::get(2);
    $views = get_log_action(self::MODEL, $product->id);
    $shares = get_log_action(self::MODEL, $product->id, 'share');
    $product = Products::where('id', $product->id)->withCount('favorites')->first();
    $new_products = Products::onlyActive()->withCount('favorites')->onlyAvailable(config('global.warehouse'))->orderBy('created_at', 'desc')->limit(12)->get();

    return view('frontend.product.detail', compact(['pages', 'product', 'new_products', 'views', 'shares']));
  }

}

