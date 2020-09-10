<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class AboutUs extends Model implements HasMedia
{
  use LogsActivity, HasMediaTrait;
  protected $table = 'about_us';
  protected $guarded = [];
  
  protected static $logName = 'about_us';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public function registerMediaCollections()
  {
    $this->addMediaCollection('image1')->singleFile();
    $this->addMediaCollection('image2')->singleFile();
    $this->addMediaCollection('image3')->singleFile();
  }

  public function storeImage()
  {
    if (request()->has('image1')) {
      $this->addMediaFromRequest('image1')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('image1');
    }

    if (request()->has('image2')) {
      $this->addMediaFromRequest('image2')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
          })->toMediaCollection('image2');
    }

    if (request()->has('image3')) {
      $this->addMediaFromRequest('image3')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
          })->toMediaCollection('image3');
    }
  }

  public function getImage1Attribute()
  {
    return $this->getFirstMediaUrl('image1');
  }

  public function getImage2Attribute()
  {
    return $this->getFirstMediaUrl('image2');
  }

  public function getImage3Attribute()
  {
    return $this->getFirstMediaUrl('image3');
  }

}
