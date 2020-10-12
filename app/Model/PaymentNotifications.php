<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class PaymentNotifications extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'payment_notifications';
    protected $guarded = [];
    protected $attributes = [
        'status' => 0,
    ];

    protected static $logName = 'payment_notifications';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->crop(\Spatie\Image\Manipulations::CROP_CENTER, 50, 50);
            });
    }

    public function storeImage()
    {
        if (request()->has('image')) {
            $this->addMediaFromRequest('image')
                ->sanitizingFileName(function ($fileName) {
                    return sanitizeFileName($fileName);
                })->toMediaCollection('image');
        }
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('image');
    }

    public function getImageThumbAttribute()
    {
        if (!empty($this->getMedia('image')[0])) {
            return $this->getMedia('image')[0]->getFullUrl('thumb');
        }

        return asset('images/backend/flag_th.jpg');
    }

    public function getStatusAttribute($attributes)
    {
        return [
            0 => 'New',
            1 => 'Done',
        ][$attributes];
    }

    public function bank_account_info()
    {
        return $this->hasOne('App\Model\BankAccounts', 'id', 'bank_accounts_id');
    }

    public function order()
    {
        return $this->hasOne('App\Model\Orders', 'code', 'orders_code');
    }

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function scopegetDataByKeyword($query, $keyword)
    {
        return $query->where('transaction_code', 'like', "%$keyword%")
            ->orWhere('orders_code', 'like', "%$keyword%")
            ->orWhere('amount', 'like', "%$keyword%");
    }
}
