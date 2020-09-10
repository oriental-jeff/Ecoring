<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\Page;
use App\Model\BannerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class BannerController extends Controller
{
  const MODULE = 'banner';
  
  public function index(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')) :
      if(Auth::user()->hasRole(['admin'])):
        $banners = Banner::with('banners_detail.')->getDataByKeyword($request->keyword)->adminOnly()->get();
      else:
        $banners = Banner::with('banners_detail.')->getDataByKeyword($request->keyword)->get();
      endif;
    else:
      if(Auth::user()->hasRole(['admin'])):
        $banners = Banner::with('banners_detail.update_name')->adminOnly()->limit(50)->get();
      else:
        $banners = Banner::with('banners_detail.update_name')->limit(50)->get();
      endif;
    endif;
    return view('backend.banner.index', compact('banners'));
  }

  public function search(Request $request) 
  {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')) :
      if(Auth::user()->hasRole(['admin'])):
        $banners = Banner::getDataByKeyword($request->keyword)->adminOnly()->get();
      else:
        $banners = Banner::getDataByKeyword($request->keyword)->get();
      endif;
    else:
      if(Auth::user()->hasRole(['admin'])):
        $banners = Banner::adminOnly()->get();
      else:
        $banners = Banner::all();
      endif;
    endif;
    return view('backend.banner.show', compact('banners'));
  }

  public function create(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    $banner = new Banner;
    $pages = Page::get();
    $positions = [ 1,2,3];
    $types = ['static', 'slide'];
    
    return view('backend.banner.create', compact(['banner', 'pages', 'positions', 'types']));
  }

  public function store(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    $banner = Banner::create($this->validateRequest());
    if($request->type == 'static'):
      $detail = [
            'banner_id' => $banner->id,
            'type' => $request->static_type,
            'url'  => $request->static_url,
      ];

      $detail['updated_by'] = Auth::id();
      $detail['created_by'] = Auth::id();
      $banner_detail = BannerDetail::create($detail);
      if($request->static_type != 'youtube'):
        $banner_detail->storeImage('static_upload_pc');
        $banner_detail->storeImage('static_upload_mobile');
      endif;
      
    else:
      $img_invoke = 0;
      foreach ($request->slide_type as $key =>$type) :
        $detail = [
            'banner_id' => $banner->id,
            'type' => $request->slide_type[$key],
            'url'  => !empty($request->slide_url[$key]) ? $request->slide_url[$key] : '',
          ];
        $detail['updated_by'] = Auth::id();
        $detail['created_by'] = Auth::id();
        $banner_detail = BannerDetail::create($detail);
        if($type == 'video'): 
          $banner_detail->storeImage('slide_upload_video', $img_invoke);
          $img_invoke++;
        elseif($type == 'image'):
          $banner_detail->storeImage('slide_upload_pc', $img_invoke);
          $banner_detail->storeImage('slide_upload_mobile', $img_invoke);
          $img_invoke++;
        endif;
      endforeach;
    endif;
    Cache::flush();

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');
   
    return redirect(route('backend.banner.index'));
  }

  public function edit(Banner $banner)
  {
    $this->authorize(mapPermission(self::MODULE));
    $positions = [ 1,2,3];
    $types = ['static', 'slide'];
    $pages = Page::get();
    return view('backend.banner.update', compact(['banner', 'pages', 'types', 'positions']));
  }

  public function update(Request $request, Banner $banner)
  {
    $this->authorize(mapPermission(self::MODULE));
    $banner->update($this->validateRequest());

    if($banner->type == 'static'):
      $detail = [
        'banner_id' => $banner->id,
        'type' => $request->edit_type,
        'url'  => $request->edit_url,
      ];

      $detail['updated_by'] = Auth::id();
      $banner_detail = BannerDetail::getBannerDetailByBannerIds([$banner->id])->first();
      $banner_detail->update($detail);
      if(request()->has('edit_upload_pc')):
        $banner_detail->storeImage('edit_upload_pc');
      endif;
      if(request()->has('edit_upload_mobile')):
        $banner_detail->storeImage('edit_upload_mobile');
      endif;
      
    else:
      $banner_detail = BannerDetail::getBannerDetailByBannerIds([$banner->id])->get();
      $banner_ids = $banner_detail->pluck('id');
      //check Delete row BannerDetail
      $diff = collect($banner_ids->diff($request->id)->all());
      //if has Delete
      if($diff->count() > 0):
        $diff->each(function($item, $key) {
          $row_delete_banner_detail = BannerDetail::find($item);
          $row_delete_banner_detail->delete();
        });
      endif;
      //edit old silde
      $img_invoke = 0;
      if($request->has('edit_type')):

        foreach ($request->edit_type as $key =>$type) :
            $edit_detail = [
                'banner_id' => $banner->id,
                'type' => $request->edit_type[$key],
                'url'  => !empty($request->edit_url[$key]) ? $request->edit_url[$key] : '',
              ];
            $edit_detail['created_by'] = Auth::id();
            $banner_detail = BannerDetail::find($request->id[$key]);
            $banner_detail->update($edit_detail);
            if($banner_detail->type == 'image'):   
              if($request->has('edit_upload_pc'.'.'.$key) ):         
                $banner_detail->storeImage('edit_upload_pc', $key);
              endif;
              if($request->has('edit_upload_mobile'.'.'.$key)): 
                  $banner_detail->storeImage('edit_upload_mobile', $key);
              endif;
            elseif($banner_detail->type == 'video'):
              if($request->has('edit_upload_pc'.'.'.$key)):
                $banner_detail->storeImage('edit_upload_video', $key);
              endif;
            endif;
        endforeach;
      else:
       //delete all old data 
        BannerDetail::getBannerDetailByBannerIds([$banner->id])->delete();
      endif; 


      //add new slide
      if ($request->has('slide_type')):
        $img_invoke = 0;
        foreach ($request->slide_type as $key =>$type) :
          $detail = [
              'banner_id' => $banner->id,
              'type' => $request->slide_type[$key],
              'url'  => !empty($request->slide_url[$key]) ? $request->slide_url[$key] : '',
            ];
          $detail['updated_by'] = Auth::id();
          $detail['created_by'] = Auth::id();
          $banner_detail = BannerDetail::create($detail);
          if($type == 'image'): 
            if(!empty($request->slide_upload_pc[$img_invoke])):

              $banner_detail->storeImage('slide_upload_pc', $img_invoke);
            endif;
            if(!empty($request->slide_upload_mobile[$img_invoke])):
              $banner_detail->storeImage('slide_upload_mobile', $img_invoke);
            endif;
            $img_invoke++;
          elseif($type == 'video'): 
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

    return redirect(route('backend.banner.index'));
  }

  public function destroy(Banner $banner)
  {
    $this->authorize(mapPermission(self::MODULE));
    $banner->delete();
    return redirect(route('backend.banner.index'));
  }

  private function validateRequest()
  {
    if(request()->route()->getActionMethod() == 'store'):
      $validatedData = request()->validate([
        "name"   => "required",
        "page_id"    => "required",
        "type"  => 'required',
        "position" => "",
      ]);
    
      request()->validate([
        "upload"  => ['sometimes', 'file','image','max:5000'],
        'slide_upload' => ['sometimes', 'array'],
        'slide_upload.*' => ['sometimes', 'file', 'max:5000'],
      ]);
    else:
     $validatedData = request()->validate([
        "name"   => "required",
        "position" => "",
      ]);

      request()->validate([
        "upload"  => ['sometimes', 'file','image','max:5000'],
        'slide_upload' => ['sometimes', 'array'],
        'slide_upload.*' => ['sometimes', 'file','max:5000'],
      ]);
    endif;
   

    return $validatedData;
  }
}



