<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class UserAddressDelivery extends Model
{
  use LogsActivity;
  protected $table = 'user_address_deliveries';
  protected $guarded = [];

  protected static $logName = 'user_address_deliveries';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

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
}
