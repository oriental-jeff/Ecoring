<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class WebInfo extends Model implements HasMedia
{
  use LogsActivity, HasMediaTrait;
  protected $table = 'web_info';
  protected $guarded = [];
  
  protected static $logName = 'web_info';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public function registerMediaCollections()
  {
    $this->addMediaCollection('logo_head')->singleFile();
    $this->addMediaCollection('logo_foot')->singleFile();
    $this->addMediaCollection('flag_th')
    ->singleFile()
      ->registerMediaConversions(function (Media $media) {
          $this->addMediaConversion('thumb')
              ->crop(\Spatie\Image\Manipulations::CROP_CENTER, 50, 50);
      });
    $this->addMediaCollection('flag_en')
      ->singleFile()
      ->registerMediaConversions(function (Media $media) {
          $this->addMediaConversion('thumb')
              ->crop(\Spatie\Image\Manipulations::CROP_CENTER, 50, 50);
      });
    $this->addMediaCollection('flag_cn')
      ->singleFile()
      ->registerMediaConversions(function (Media $media) {
          $this->addMediaConversion('thumb')
              ->crop(\Spatie\Image\Manipulations::CROP_CENTER, 50, 50);
      });
    $this->addMediaCollection('image_alacarte')->singleFile();
    $this->addMediaCollection('image_buffet')->singleFile();
    $this->addMediaCollection('image_delivery')->singleFile();
       
  }

  public function storeImage()
  {
    if (request()->has('image_logo_head')) {
      $this->addMediaFromRequest('image_logo_head')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('logo_head');
    }

    if (request()->has('image_logo_foot')) {
      $this->addMediaFromRequest('image_logo_foot')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
          })->toMediaCollection('logo_foot');
    }

    if (request()->has('image_flag_th')) {
      $this->addMediaFromRequest('image_flag_th')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
          })->toMediaCollection('flag_th');
    }
    if (request()->has('image_flag_en')) {
      $this->addMediaFromRequest('image_flag_en')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
          })->toMediaCollection('flag_en');
    }
    if (request()->has('image_flag_cn')) {
      $this->addMediaFromRequest('image_flag_cn')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
          })->toMediaCollection('flag_cn');
    }
    if (request()->has('image_alacarte')) {
      $this->addMediaFromRequest('image_alacarte')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('image_alacarte');
    }

    if (request()->has('image_buffet')) {
      $this->addMediaFromRequest('image_buffet')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
          })->toMediaCollection('image_buffet');
    }

    if (request()->has('image_delivery')) {
      $this->addMediaFromRequest('image_delivery')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
          })->toMediaCollection('image_delivery');
    }
  }

  public function getHasLogoHeadAttribute()
  {
    return !empty($this->getMedia('image_logo_head')[0]);
  }


  public function getLogoHeadAttribute()
  {
    return $this->getFirstMediaUrl('logo_head');
  }

  public function getLogoFootAttribute()
  {
    return $this->getFirstMediaUrl('logo_foot');
  }

  public function getFlagThAttribute()
  {
    return $this->getFirstMediaUrl('flag_th');
  }

  public function getFlagEnAttribute()
  {
    return $this->getFirstMediaUrl('flag_en');
  }

  public function getFlagCnAttribute()
  {
    return $this->getFirstMediaUrl('flag_cn');
  }

  public function getImageAlacarteAttribute()
  {
    return $this->getFirstMediaUrl('image_alacarte');
  }

  public function getImageBuffetAttribute()
  {
    return $this->getFirstMediaUrl('image_buffet');
  }

  public function getImageDeliveryAttribute()
  {
    return $this->getFirstMediaUrl('image_delivery');
  }

  public function getFlagThThumbAttribute()
  {
    if (!empty($this->getMedia('flag_th')[0])) {
      return $this->getMedia('flag_th')[0]->getFullUrl('thumb');
    }
    return asset('images/backend/flag_th.jpg');
  }

  public function getFlagEnThumbAttribute()
  {
    if (!empty($this->getMedia('flag_en')[0])) {
      return $this->getMedia('flag_en')[0]->getFullUrl('thumb');
    }
    return asset('images/backend/avatar.jpg');
  }

  public function getFlagCnThumbAttribute()
  {
    if (!empty($this->getMedia('flag_cn')[0])) {
      return $this->getMedia('flag_cn')[0]->getFullUrl('thumb');
    }
    return asset('images/backend/avatar.jpg');
  }

}
