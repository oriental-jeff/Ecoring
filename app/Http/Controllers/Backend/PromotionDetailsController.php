<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Promotions;
use App\Model\Page;
use App\Model\PromotionDetails;
use App\Model\Products;
use App\Model\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;

class PromotionDetailsController extends Controller
{
    const MODULE = 'promotion_details';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $promotion_details = PromotionDetails::getDataByKeyword($request->keyword)->get();
        else :
            $promotion_details = PromotionDetails::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;
        return view('backend.promotion_details.index', compact('promotion_details'));
    }

    public function search(Request $request)
    {
        // $this->authorize(mapPermission(self::MODULE));
        // if ($request->filled('keyword')) :
        //     if (Auth::user()->hasRole(['admin'])) :
        //         $promotion_details = PromotionDetails::getDataByKeyword($request->keyword)->adminOnly()->get();
        //     else :
        //         $promotion_details = PromotionDetails::getDataByKeyword($request->keyword)->get();
        //     endif;
        // else :
        //     if (Auth::user()->hasRole(['admin'])) :
        //         $promotion_details = PromotionDetails::adminOnly()->get();
        //     else :
        //         $promotion_details = PromotionDetails::all();
        //     endif;
        // endif;
        // return view('backend.promotion_details.show', compact('promotion_details'));
    }

    public function create(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $promotions = Promotions::onlyActive()->get();
        $promotion_details = new PromotionDetails;
        $products = Products::onlyActive()->get();
        $tags = Tags::all();
        $pages = Page::get();

        return view('backend.promotion_details.create', compact(['promotions', 'promotion_details', 'pages', 'products', 'tags']));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        try {
            foreach ($request->products_id as $key => $product) :
                $detail = [
                    'promotions_id' => $request->promotions_id,
                    'products_id' => $product,
                    'price'  => $request->price[$key],
                ];
                $detail['updated_by'] = Auth::id();
                $detail['created_by'] = Auth::id();
                $promotion_detail = PromotionDetails::create($detail);
            endforeach;

            $message = 'บันทึกข้อมูลเรียบร้อย';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-success');

            return redirect(route('backend.promotion_details.index'));
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withInput();
        }
    }

    public function edit(PromotionDetails $promotion_detail)
    {
        $this->authorize(mapPermission(self::MODULE));
        $pages = Page::get();
        $promotions = Promotions::onlyActive()->get();
        $products = Products::onlyActive()->get();
        return view('backend.promotion_details.update', compact(['promotion_detail', 'promotions', 'products', 'pages']));
    }

    public function update(Request $request, PromotionDetails $promotion_detail)
    {
        $this->authorize(mapPermission(self::MODULE));
        try {
            $detail = [
                'price'  => $request->price[0],
            ];
            $detail['updated_by'] = Auth::id();
            $promotion_detail = $promotion_detail->update($detail);

            $message = 'แก้ไขข้อมูลเรียบร้อย';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-success');

            return redirect(route('backend.promotion_details.index'));
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withInput();
        }
    }

    public function destroy(PromotionDetails $promotion_details)
    {
        $this->authorize(mapPermission(self::MODULE));
        $promotion_details->delete();
        return redirect(route('backend.promotion_details.index'));
    }

    /**
     * Get Product Promotion
     */
    public function promotion(Request $request)
    {
        $products = Products::selectRaw('id, created_at, name_th, sku, categories_id');
        // $products = Products::select(['id','created_at','name_th','sku','categories_id']);
        return datatables()->of($products)
        ->addColumn('image', function ($q) {
            $image= asset($q->image);
            return '<img src="'.$image.'" class="img-table">';
        })
        ->addColumn('categorie', function ($q) {
            return $q->categories_name->name_th;
        })
        ->addColumn('tags', function ($q) {
            $t = $q->producttags;
            $s = '';
            foreach ($t as $k => $v) {
                $s .= $v->tags->name_th.",";
            }
            return $s;
        })
        ->editColumn('created_at', function ($q){
            return date('d/m/Y H:i:s', strtotime($q->created_at) );
        })
        ->rawColumns(['image'])->make(true);
    }
}
