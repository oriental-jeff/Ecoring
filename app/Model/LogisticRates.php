<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class LogisticRates extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'logistic_rates';
    protected $guarded = [];

    protected static $logName = 'logistic_rates';
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

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function logistic()
    {
        return $this->hasOne('App\Model\Logistics', 'id', 'logistics_id');
    }

    public function scopegetDataByKeyword($query, $request)
    {
        $keyword = $request->keyword;
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        if ($keyword) {
            $query = $query->where('name_th', 'like', "%$keyword%")
                ->orWhere('name_en', 'like', "%$keyword%")
                ->orWhere('weight_from', 'like', "%$keyword%")
                ->orWhere('weight_to', 'like', "%$keyword%")
                ->orWhere('price', 'like', "%$keyword%");
        }
        // Check date
        if ($date_start and $date_end) {
            $query = $query->where('start_at', '>=', $date_start)->where('end_at', '<=', $date_end);
        } else if ($date_start and !$date_end) {
            $query = $query->where('start_at', '>=', $date_start);
        } else if (!$date_start and $date_end) {
            $query = $query->where('end_at', '<=', $date_end);
        }
        return $query;
    }
}
