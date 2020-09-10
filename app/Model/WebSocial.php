<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class WebSocial extends Model implements HasMedia
{
  use LogsActivity, HasMediaTrait;
  protected $table = 'web_social';
  protected $guarded = [];
  protected $attributes = [
    'active' => 1,
  ];

  protected static $logName = 'web_social';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public function registerMediaCollections()
  {
    $this->addMediaCollection('image')->singleFile();
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
     1 => 'Active' ,
     0 =>'Inactive'
    ][$attributes];
  }

  public function getImageAttribute()
  {
    return $this->getFirstMediaUrl('image');
  }

  public function update_name() {
    return $this->hasOne('App\User', 'id', 'updated_by');
  }

  public function scopeonlyActive($query) {
    return $query->where('active', 1);
  }

  public function scopegetDataByKeyword($query, $keyword) {
    return $query->where('name', 'like', "%$keyword%"); 
  }
}
