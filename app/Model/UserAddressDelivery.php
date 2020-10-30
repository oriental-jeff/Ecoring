<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class UserAddressDelivery extends Model
{
  use LogsActivity, SoftDeletes;
  protected $table = 'user_address_deliveries';
  protected $guarded = [];

  protected static $logName = 'user_address_deliveries';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

  public $timestamps = true;

    public function users() {
        return $this->hasOne('App\User', 'id', 'user_id');
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

    // S C O P E S
    public function scopeGetAddressDeliveryByUserIds($query, $user_ids) {
        return $query->whereIn('user_id', $user_ids);
    }
}
