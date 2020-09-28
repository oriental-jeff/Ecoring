<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Promotions;
use App\Model\Page;
use App\Model\PromotionDetails;
use App\Model\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class PromotionDetailsController extends Controller
{
    const MODULE = 'promotion_details';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $promotion_details = PromotionDetails::getDataByKeyword($request->keyword)->get();
        else :
            $promotion_details = PromotionDetails::limit(50)->get();
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
        $pages = Page::get();

        return view('backend.promotion_details.create', compact(['promotions', 'promotion_details', 'pages', 'products']));
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
                $banner_detail = PromotionDetails::create($detail);
            endforeach;

            $message = 'บันทึกข้อมูลเรียบร้อย';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-success');

            return redirect(route('backend.promotion_details.index'));
        } catch (\Throwable $th) {

            // return back()->withErrors(['msg', 'โปรดระบุข้อมูลสำคัญให้ครบ']);
            return redirect()->back()
                ->withInput();
        }
    }

    public function edit(PromotionDetails $banner)
    {
        $this->authorize(mapPermission(self::MODULE));
        $positions = [1, 2, 3];
        $types = ['static', 'slide'];
        $pages = Page::get();
        return view('backend.promotion_details.update', compact(['banner', 'pages', 'types', 'positions']));
    }

    public function update(Request $request, PromotionDetails $banner)
    {
        $this->authorize(mapPermission(self::MODULE));
        $banner->update($this->validateRequest());

        if ($banner->type == 'static') :
            $detail = [
                'banner_id' => $banner->id,
                'type' => $request->edit_type,
                'url'  => $request->edit_url,
            ];

            $detail['updated_by'] = Auth::id();
            $banner_detail = PromotionDetailsDetail::getPromotionDetailsDetailByPromotionDetailsIds([$banner->id])->first();
            $banner_detail->update($detail);
            if (request()->has('edit_upload_pc')) :
                $banner_detail->storeImage('edit_upload_pc');
            endif;
            if (request()->has('edit_upload_mobile')) :
                $banner_detail->storeImage('edit_upload_mobile');
            endif;

        else :
            $banner_detail = PromotionDetailsDetail::getPromotionDetailsDetailByPromotionDetailsIds([$banner->id])->get();
            $banner_ids = $banner_detail->pluck('id');
            //check Delete row PromotionDetailsDetail
            $diff = collect($banner_ids->diff($request->id)->all());
            //if has Delete
            if ($diff->count() > 0) :
                $diff->each(function ($item, $key) {
                    $row_delete_banner_detail = PromotionDetailsDetail::find($item);
                    $row_delete_banner_detail->delete();
                });
            endif;
            //edit old silde
            $img_invoke = 0;
            if ($request->has('edit_type')) :

                foreach ($request->edit_type as $key => $type) :
                    $edit_detail = [
                        'banner_id' => $banner->id,
                        'type' => $request->edit_type[$key],
                        'url'  => !empty($request->edit_url[$key]) ? $request->edit_url[$key] : '',
                    ];
                    $edit_detail['created_by'] = Auth::id();
                    $banner_detail = PromotionDetailsDetail::find($request->id[$key]);
                    $banner_detail->update($edit_detail);
                    if ($banner_detail->type == 'image') :
                        if ($request->has('edit_upload_pc' . '.' . $key)) :
                            $banner_detail->storeImage('edit_upload_pc', $key);
                        endif;
                        if ($request->has('edit_upload_mobile' . '.' . $key)) :
                            $banner_detail->storeImage('edit_upload_mobile', $key);
                        endif;
                    elseif ($banner_detail->type == 'video') :
                        if ($request->has('edit_upload_pc' . '.' . $key)) :
                            $banner_detail->storeImage('edit_upload_video', $key);
                        endif;
                    endif;
                endforeach;
            else :
                //delete all old data
                PromotionDetailsDetail::getPromotionDetailsDetailByPromotionDetailsIds([$banner->id])->delete();
            endif;


            //add new slide
            if ($request->has('slide_type')) :
                $img_invoke = 0;
                foreach ($request->slide_type as $key => $type) :
                    $detail = [
                        'banner_id' => $banner->id,
                        'type' => $request->slide_type[$key],
                        'url'  => !empty($request->slide_url[$key]) ? $request->slide_url[$key] : '',
                    ];
                    $detail['updated_by'] = Auth::id();
                    $detail['created_by'] = Auth::id();
                    $banner_detail = PromotionDetailsDetail::create($detail);
                    if ($type == 'image') :
                        if (!empty($request->slide_upload_pc[$img_invoke])) :

                            $banner_detail->storeImage('slide_upload_pc', $img_invoke);
                        endif;
                        if (!empty($request->slide_upload_mobile[$img_invoke])) :
                            $banner_detail->storeImage('slide_upload_mobile', $img_invoke);
                        endif;
                        $img_invoke++;
                    elseif ($type == 'video') :
                        $banner_detail->storeImage('slide_upload_video', $img_invoke);
                        $img_invoke++;
                    endif;
                endforeach;
            endif;
        endif;
        Cache::flush();

        $message = 'แก้ไขข้อมูลเรียบร้อย';
        $request->session()->flash('message', $message);
        $request->session()->flash('alert-class', 'alert-success');

        return redirect(route('backend.promotion_details.index'));
    }

    public function destroy(PromotionDetails $promotion_details)
    {
        $this->authorize(mapPermission(self::MODULE));
        $promotion_details->delete();
        return redirect(route('backend.promotion_details.index'));
    }

    private function validateRequest()
    {
        if (request()->route()->getActionMethod() == 'store') :
            $validatedData = request()->validate([
                "promotions_id"   => "required",
            ]);
        else :
            $validatedData = request()->validate([
                "promotions_id"   => "required",
            ]);
        endif;


        return $validatedData;
    }
}
