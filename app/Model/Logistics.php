<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Logistics extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'logistics';
    protected $attributes = [
        'active' => 1,
    ];
    protected $guarded = [];

    protected static $logName = 'logistics';
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

    public function getActiveAttribute($attributes)
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ][$attributes];
    }

    public function getLogisticPriceAttribute()
    {
        // dd($weight);
        // dd(session()->get('weight'));
        $weight = session()->get('weight');
        $price_length = $this->hasOne('App\Model\LogisticRates', 'logistics_id', 'id')->whereRaw($weight . ' >= weight_from AND ' . $weight . ' <= weight_to')->whereRaw('curdate() >= start_at AND curdate() <= end_at')->orderBy('id', 'desc')->first();
        if (!empty($price_length)) :
            $price = $price_length->price;
        else :
            $price = $this->base_price;
        endif;

        return $price;
    }

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function scopeonlyActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopegetDataByKeyword($query, $request)
    {
        $keyword = $request->keyword;
        $active = $request->active;
        if ($keyword) {
            $query = $query->where('name_th', 'like', "%$keyword%")
                ->orWhere('name_en', 'like', "%$keyword%")
                ->orWhere('period', 'like', "%$keyword%")
                ->orWhere('base_price', 'like', "%$keyword%");
        }
        if ($active === "0" or $active === "1") {
            $query = $query->where('active', (int) $active);
        }
        return $query;
    }
}
