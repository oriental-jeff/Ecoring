<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Gallery extends Model implements HasMedia
{
  use HasMediaTrait;
  protected $table = 'gallery';
  protected $guarded = [];

  public function registerMediaCollections()
  {
    $this->addMediaCollection('image');
 
  }

  public function storeImage()
  {
    if (request()->has('image')) {
      $this->addMediaFromRequest('image')
          ->sanitizingFileName(function($fileName) {
            return sanitizeFileName($fileName);
           })->toMediaCollection('image');
    }
  }

    public function getImageAttribute()
  {
        return $this->getMedia('image');
  }
  

}