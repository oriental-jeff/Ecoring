<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Branch extends Model implements HasMedia
{
  use SoftDeletes, LogsActivity, HasMediaTrait;
  protected $table = 'branch';
  protected $guarded = [];
  protected $attributes = [
    'active' => 1,
  ];

  protected static $logName = 'branch';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public function registerMediaCollections()
  {
    $this->addMediaCollection('image')
    ->singleFile()
      ->registerMediaConversions(function (Media $media) {
          $this->addMediaConversion('thumb')
              ->crop(\Spatie\Image\Manipulations::CROP_CENTER, 50, 50);
      });
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

  public function getActiveAttribute($attributes) {
    return  [
      1 => 'Active',
      0 =>'Inactive'
    ][$attributes];
  }

  public function getImageAttribute()
  {
    return $this->getFirstMediaUrl('image');
  }

  public function getImageThumbAttribute()
  {
    if (!empty($this->getMedia('image')[0])) {
      return $this->getMedia('image')[0]->getFullUrl('thumb');
    }
    return asset('images/backend/flag_th.jpg');
  }

  public function update_name() {
    return $this->hasOne('App\User', 'id', 'updated_by');
  }

  public function scopeonlyActive($query) {
    return $query->where('active', 1);
  }

  public function scopegetDataByKeyword($query, $keyword) {
    return $query->where('name_th', 'like', '%$keyword%')
      ->orWhere('name_en', 'like', '%$keyword%')
      ->orWhere('address_th', 'like', '%$keyword%')
      ->orWhere('address_en', 'like', '%$keyword%');
  }
}
