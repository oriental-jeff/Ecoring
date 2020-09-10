<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
  use SoftDeletes, LogsActivity;
  protected $table = 'pages';
  protected $guarded = [];


  protected static $logName = 'pages';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;
  public function banners() {
    return $this->belongTo('App\Banner', 'id');
  }

  public function update_name() {
      return $this->hasOne('App\User', 'id', 'updated_by');
  }

  public function menus() {
    return $query->belongTo('App\Model\Menu');
  }

  public function scopegetDataByKeyword($query, $keyword) {
    return $query->where('name', 'like', "%$keyword%")
      ->orWhere('title_th', 'like', "%$keyword%")
      ->orWhere('title_en', 'like', "%$keyword%")
      ->orWhere('title_cn', 'like', "%$keyword%");
  }

}
