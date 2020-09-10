<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Amphure extends Model
{
  use LogsActivity;
  protected $table = 'amphures';
  protected $guarded = [];
  protected $attributes = [
    'active' => 1,
  ];

  protected static $logName = 'amphure';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public function getActiveAttribute($attributes) {
    return  [ 
     1 => 'Active' ,
     0 =>'Inactive'
    ][$attributes];
  }

  public function update_name() {
    return $this->hasOne('App\User', 'id', 'updated_by');
  }

  public function scopeonlyActive($query) {
    return $query->where('active', 1);
  }

  public function scopegetDataByKeyword($query, $keyword) {
    return $query->where('name_th', 'like', "%$keyword%")
      ->orWhere('name_en', 'like', "%$keyword%");
  }
}
