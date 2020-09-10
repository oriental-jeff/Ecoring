<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Models\Media;

class BannerDetail extends Model implements HasMedia
{
  use LogsActivity, HasMediaTrait;
  protected $table = 'banner_detail';
  protected $guarded = [];

  protected static $logName = 'banners';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public function registerMediaCollections()
  {
    $this->addMediaCollection('video')->singleFile();
    $this->addMediaCollection('image_pc')->singleFile();
    $this->addMediaCollection('image_mobile')->singleFile();

    // $this->addMediaCollection('image_pc')
    // ->singleFile()
    // ->registerMediaConversions(function (Media $media) {
    //     $this->addMediaConversion('thumb')
    //         ->crop(\Spatie\Image\Manipulations::CROP_CENTER, 200, 100);
    // });

    // $this->addMediaCollection('image_mobile')
    // ->singleFile()
    // ->registerMediaConversions(function (Media $media) {
    //     $this->addMediaConversion('thumb')
    //         ->crop(\Spatie\Image\Manipulations::CROP_CENTER, 200, 100);
    // });
  }

  public function storeImage($file_name, $key='')
  {
    if (!is_int($key) && request()->has($file_name)) :
      if($file_name == 'static_upload_pc' || $file_name == 'edit_upload_pc') :
        $this->addMediaFromRequest($file_name)
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('image_pc');
      elseif($file_name == 'static_upload_mobile' || $file_name == 'edit_upload_mobile') :
        $this->addMediaFromRequest($file_name)
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('image_mobile');
      else :
        $this->addMediaFromRequest($file_name)
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('video');
      endif;

    elseif (request()->has($file_name.'.'.$key)) :
      if($file_name == 'slide_upload_pc' || $file_name == 'edit_upload_pc') :
    
        $this->addMediaFromRequest($file_name.'.'.$key)
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('image_pc');

      elseif ($file_name == 'slide_upload_mobile' || $file_name == 'edit_upload_mobile') :
  
        $this->addMediaFromRequest($file_name.'.'.$key)
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('image_mobile');
      endif;

    else:
        $this->addMediaFromRequest('slide_upload_pc.'.$key)
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('video');
    endif;
  }

  public function scopegetBannerDetailByBannerIds($query, $banner_ids) {
    return $query->whereIn('banner_id', $banner_ids);
  }

 
   public function getBannerAttribute()
  {
    return $this->getFirstMediaUrl('image');
  }

  public function getBannerVideoAttribute()
  {
    return $this->getFirstMediaUrl('video');
  }


  public function getSlideBannerPcAttribute()
  {
    return $this->getFirstMediaUrl('image_pc');
  }

    public function getSlideBannerMobileAttribute()
  {
    return $this->getFirstMediaUrl('image_mobile');
  }

   public function getSlideBannerVideoAttribute()
  {
    return $this->getFirstMediaUrl('video');
  }


  // public function getImageThumbAttribute()
  // {
  //     if (!empty($this->getMedia('image_pc')[0])) {
  //         return $this->getMedia('image_pc')[0]->getFullUrl('thumb');
  //     } elseif(!empty($this->getMedia('image')[0])) {
  //        return $this->getMedia('image')[0]->getFullUrl('thumb');
  //     }
  //     return asset('images/backend/flag_th.jpg');
  // }

  // public function getImageThumbMobileAttribute()
  // {
  //     if (!empty($this->getMedia('image_mobile')[0])) {
  //         return $this->getMedia('image_mobile')[0]->getFullUrl('thumb');
  //     }
  //     return asset('images/backend/flag_th.jpg');
  // }

  public function banners() {
    return $this->hasOne('App\Model\Banner', 'id', 'banner_id');
  }

   public function update_name() {
    return $this->hasOne('App\User', 'id', 'updated_by');
  }

}
