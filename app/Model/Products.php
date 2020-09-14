<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Products extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'products';
    protected $guarded = [];
    protected $attributes = [
        'recommend' => 0,
        'active' => 1,
    ];

    protected static $logName = 'products';
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

    public function getRecommendAttribute($attributes)
    {
        return [
            1 => 'Recommend',
            0 => 'Normal',
        ][$attributes];
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

    public function categories_name()
    {
        return $this->hasOne('App\Model\Categories', 'id', 'categories_id');
    }

    public function grades_name()
    {
        return $this->hasOne('App\Model\Grades', 'id', 'grades_id');
    }

    public function scopeonlyActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopegetDataByKeyword($query, $request)
    {
        $keyword = $request->keyword;
        $active = $request->active;
        $recommend = $request->recommend;
        if ($keyword) {
            $query = $query->where('name_th', 'like', "%$keyword%")
                ->orWhere('name_en', 'like', "%$keyword%")
                ->orWhereHas('categories_name', function ($q1) use ($keyword) {
                    $q1->where('name_th', 'like', "%$keyword%")
                        ->orWhere('name_en', 'like', "%$keyword%");
                });
        }
        if ($active === "0" or $active === "1") {
            $query = $query->where('active', (int) $active);
        }
        if ($recommend === "1") {
            $query = $query->where('recommend', (int) $recommend);
        }
        return $query;
    }
}
