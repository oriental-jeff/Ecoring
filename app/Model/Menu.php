<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
  use LogsActivity;
  protected $table = 'menus';
  protected $guarded = [];

  protected static $logName = 'menu';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;


  public function scopeonlyParent($query) {
    return $query->whereNull('parent_id');
  }

  public function pages() {
    return $this->hasOne('App\Model\Page', 'id', 'page_id');
  }

  public function children() {
    return $this->hasMany(self::class, 'parent_id')->orderBy('sort', 'asc');
  }

  public function childrens()
  {
      return $this->children()->with('childrens');
  }

  public function update_name() {
    return $this->hasOne('App\User', 'id', 'updated_by');
  }

  public function scopeonlyActive($query) {
    return $query->where('active', 1);
  }

}
