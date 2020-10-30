<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Models\Media;

class UserProfile extends Model implements HasMedia
{
  use LogsActivity, HasMediaTrait;
  protected $table = 'user_profile';
  protected $guarded = [];

  protected static $logName = 'user_profile';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public function registerMediaCollections()
  {
    $this->addMediaCollection('avatar')->singleFile();
  }

  public function users() {
    return $this->belongsTo('App\User', 'id', 'user_id');
  }

  public function provinces() {
    return $this->hasOne('App\Model\Province', 'id', 'province_id');
  }

  public function districts() {
    return $this->hasOne('App\Model\District', 'id', 'district_id');
  }

  public function sub_districts() {
    return $this->hasOne('App\Model\SubDistrict', 'id', 'sub_district_id');
  }

//   Image
  public function storeImage($file_name) {
    $this->addMediaFromRequest($file_name)->sanitizingFileName(function($fileName) {
        return sanitizeFileName($fileName);
    })->toMediaCollection('avatar');
  }

  public function getAvatarAttribute()
  {
    return $this->getFirstMediaUrl('avatar');
  }
}
