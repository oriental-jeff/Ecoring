<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Banner extends Model
{
  use LogsActivity;
  protected $table = 'banners';
  protected $guarded = [];
  public $timestamps = false;

  protected static $logName = 'banners';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  /* public function update_name() {
      return $this->hasOne('App\User', 'id', 'updated_by');
  }*/

  public function pages() {
      return $this->hasOne('App\Model\Page', 'id', 'page_id');
  }

  public function banners_detail() {
    // return $this->hasMany('App\Model\BannerDetail')->orderBy('slide_position', 'ASC');
    return $this->hasMany('App\Model\BannerDetail');
  }

  public function scopegetDataByKeyword($query, $keyword) {
    return $query->where('name', 'like', "%$keyword%");
  }

  public function scopebannerActive($query) {
    return $query->where('active', 1);
  }
}
