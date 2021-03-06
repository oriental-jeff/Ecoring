<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait, SoftDeletes;
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

    public function getImageDetailAttribute()
    {
        return $this->getMedia('image_detail');
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

    public function promotion_details()
    {
        return $this->hasMany('App\Model\PromotionDetails');
    }

    public function producttags()
    {
        return $this->hasMany('App\Model\ProductTags');
    }

    public function grades_name()
    {
        return $this->hasOne('App\Model\Grades', 'id', 'grades_id');
    }

    public function stocks()
    {
        return $this->hasMany('App\Model\Stocks', 'products_id', 'id')->where('warehouses_id', config('global.warehouse'));
    }

    public function favorites()
    {
        return $this->hasMany('App\Model\Favorites', 'products_id', 'id')->where('user_id', Auth::id());
    }

    public function prices()
    {
        return $this->hasOne('App\Model\ProductPrices', 'products_id', 'id')->where('active', 1)->whereRaw('curdate() between start_at and end_at');
    }

    public function getProductPriceAttribute()
    {
        $promotion = $this->hasOne('App\Model\PromotionDetails', 'products_id', 'id')
          ->whereHas('promotions', function ($q) {
            $q->whereRaw('curdate() between start_at and end_at');
        })->orderBy('id', 'desc')->first();

        if (!empty($promotion)):
          $price = $promotion->price;
        else:
          $price_length = $this->hasOne('App\Model\ProductPrices', 'products_id', 'id')->where('active', 1)->whereRaw('curdate() >= start_at')->orderBy('id', 'desc')->first();
          if (!empty($price_length)):
            $price = $price_length->price;
          else:
            $price = $this->price;
          endif;
        endif;

        return $price;
    }

    public function getNameAttribute()
    {
        return "{$this->name_th} ( {$this->name_en} )";
    }

    public function scopeonlyActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeonlyAvailable($query, $warehouse = 1)
    {
        return $query->whereHas('stocks', function ($q) use ($warehouse) {
            $q->where('warehouses_id', $warehouse)
                ->where('quantity', '>', 0);
        });
    }

    public function scopegetDataByKeyword($query, $request)
    {
        $keyword = $request->keyword;
        $active = $request->active;
        $recommend = $request->recommend;

        if ($keyword) {
            $query = $query->where('name_th', 'like', "%$keyword%")
                ->orWhere('name_en', 'like', "%$keyword%")
                ->orWhere('sku', 'like', "%{$keyword}%")
                ->orWhere('code', 'like', "%{$keyword}%")
                ->orWhereHas('categories_name', function ($q1) use ($keyword) {
                    $q1->where('name_th', 'like', "%$keyword%")
                        ->orWhere('name_en', 'like', "%$keyword%");
                })
                ->orWhereHas('producttags.tags', function ($q2) use ($keyword) {
                    $q2->where('name_th', 'like', "%$keyword%")
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

    public function scopegetDataByCategory($query, $category)
    {
        $query = $query->whereIn('categories_id', $category);

        return $query;
    }

    public function scopegetDataByGrade($query, $grade)
    {
        $query = $query->whereIn('grades_id', $grade);

        return $query;
    }

    public function scopegetDataByPriceLength($query, $request)
    {
        $query = $query->whereBetween('price', [$request->start_price, $request->end_price])
            ->orWhereBetween('full_price', [$request->start_price, $request->end_price]);

        return $query;
    }
}
