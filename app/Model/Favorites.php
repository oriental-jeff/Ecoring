<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Favorites extends Model
{
  use LogsActivity;
  protected $table = 'favorites';
  protected $guarded = [];

  protected static $logName = 'favorite';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public function getActiveAttribute($attributes) {
    return  [ 
     1 => 'Active' ,
     0 =>'Inactive'
    ][$attributes];
  }

  public function products()
  {
    return $this->belongsTo('App\Model\Products', 'products_id', 'id');
  }

  public function update_name() {
    return $this->hasOne('App\User', 'id', 'updated_by');
  }

  public function scopeonlyActive($query) {
    return $query->where('active', 1);
  }

}
