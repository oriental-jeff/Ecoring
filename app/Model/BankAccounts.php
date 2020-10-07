<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BankAccounts extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'bankaccounts';
    protected $guarded = [];
    protected $attributes = [
        'active' => 1,
    ];

    protected static $logName = 'bankaccounts';
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
        $this->addMediaCollection('image_qrcode')
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
        if (request()->has('image_qrcode')) {
            $this->addMediaFromRequest('image_qrcode')
                ->sanitizingFileName(function ($fileName) {
                    return sanitizeFileName($fileName);
                })->toMediaCollection('image_qrcode');
        }
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('image');
    }
    public function getImageQrcodeAttribute()
    {
        return $this->getFirstMediaUrl('image_qrcode');
    }

    public function getImageThumbAttribute()
    {
        if (!empty($this->getMedia('image')[0])) {
            return $this->getMedia('image')[0]->getFullUrl('thumb');
        }
        return asset('images/backend/flag_th.jpg');
    }
    public function getImageQrcodeThumbAttribute()
    {
        if (!empty($this->getMedia('image_qrcode')[0])) {
            return $this->getMedia('image_qrcode')[0]->getFullUrl('thumb');
        }
        return asset('images/backend/flag_th.jpg');
    }

    public function getActiveAttribute($attributes)
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ][$attributes];
    }

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function scopeonlyActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopegetDataByKeyword($query, $keyword)
    {
        return $query->where('acc_no', 'like', "%$keyword%")
            ->orWhere('acc_name', 'like', "%$keyword%")
            ->orWhere('bank_name_th', 'like', "%$keyword%")
            ->orWhere('bank_name_en', 'like', "%$keyword%")
            ->orWhere('linkurl', 'like', "%$keyword%");
    }
}
