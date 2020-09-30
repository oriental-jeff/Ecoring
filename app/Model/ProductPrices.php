<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ProductPrices extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'product_prices';
    protected $guarded = [];
    protected $attributes = [
        'active' => 1,
    ];

    protected static $logName = 'product_prices';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function products()
    {
        return $this->belongsTo('App\Model\Products');
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

    public function scopegetDataByKeyword($query, $keyword)
    {
        return $query->where('price', 'like', "%$keyword%")
            ->orWhereHas('products', function ($q1) use ($keyword) {
                $q1->where('name_th', 'like', "%$keyword%")
                    ->orWhere('name_en', 'like', "%$keyword%");
            });
    }
}
