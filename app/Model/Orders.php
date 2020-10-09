<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Orders extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'order';
    protected $attributes = [
        'status' => 0,
    ];
    protected $guarded = [];

    protected static $logName = 'order';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function provinces()
    {
        return $this->hasOne('App\Model\Province', 'id', 'province_id');
    }

    public function districts()
    {
        return $this->hasOne('App\Model\District', 'id', 'district_id');
    }

    public function sub_districts()
    {
        return $this->hasOne('App\Model\SubDistrict', 'id', 'sub_district_id');
    }

    public function transaction()
    {
        return $this->hasOne('App\Model\Transactions');
    }

    public function cart()
    {
        return $this->hasMany('App\Model\Cart');
    }

    public function product()
    {
        return $this->hasOne('App\Model\Products', 'id', 'products_id');
    }

    public function logistic()
    {
        return $this->hasOne('App\Model\Logistics', 'id', 'logistics_id');
    }

    public function warehouse()
    {
        return $this->hasOne('App\Model\Warehouses', 'id', 'warehouses_id');
    }

    public function status_config()
    {
        return $this->hasOne('App\Model\StatusConfig', 'status_id', 'status');
    }

    // public function getStatusAttribute($attributes)
    // {
    //     return [
    //         0 => 'รอการชำระเงิน',
    //         1 => 'รอการตรวจสอบ',
    //         2 => 'ยกเลิกคำสั่งซื้อ',
    //         3 => 'ชำระเงินแล้ว',
    //         4 => 'กำลังจัดเตรียมสินค้า',
    //         5 => 'จัดส่งสินค้า',
    //     ][$attributes];
    // }

    public function scopeonlyNotPay($query)
    {
        return $query->where('status', 0);
    }

    public function scopegetDataByKeyword($query, $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $query = $query
                ->whereHas('product', function ($q1) use ($keyword) {
                    $q1->where('name_th', 'like', "%$keyword%")
                        ->orWhere('name_en', 'like', "%$keyword%");
                })
                ->orWhereHas('warehouse', function ($q2) use ($keyword) {
                    $q2->where('name', 'like', "%$keyword%");
                });
        }
        return $query;
    }
}
