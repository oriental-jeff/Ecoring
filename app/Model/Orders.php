<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Carbon\Carbon;

class Orders extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'order';
    protected $attributes = [
        'payment_type' => 0,
        'pickup_optional' => 0,
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

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
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

    // G E T - D A T A
    public function getPaymentTypeAttribute($attributes)
    {
        return [1 => 'ชำระผ่านบัตรเครดิต/เดบิต', 0 => 'โอนเข้าบัญชีธนาคาร'][$attributes];
    }

    public function getPickupOptionalNameAttribute($attributes)
    {
        return [
            1 => 'มารับสินค้าเอง',
            0 => 'ใช้ช่องทางการจัดส่ง',
        ][$attributes];
    }

    // S C O P E S
    public function scopeonlyNotPay($query)
    {
        return $query->where('status', 0);
    }

    public function scopegetDataByKeyword($query, $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        if ($keyword) {
            $query = $query->where('code', 'like', "%$keyword%")
                ->orWhere('tracking_no', 'like', "%$keyword%");
        }
        if (isset($status) || $status) {
            $query = $query->where('status', (int) $status);
        }
        return $query;
    }

    public function scopeReportGetSearchData($query, $request) {
        $keyword = $request->keyword;
        $payment_type = $request->payment_type;
        $status = $request->status;
        $from = Carbon::parse(str_replace('/', '-', $request->from))->toDateString();
        $to = Carbon::parse(str_replace('/', '-', $request->to))->toDateString();

        // If has date
        if ($request->has('from')) {
            $where = [
                ['created_at', '>=', $from],
                ['created_at', '<=', $to],
            ];
        }

        if ($payment_type != 'all') {
            $where += [['payment_type', $payment_type]];
        }

        if ($status != 'all') {
            $where += [['status', $status]];
        }

        return $query->where($where);
    }
}
