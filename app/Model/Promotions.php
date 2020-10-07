<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Promotions extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'promotions';
    protected $guarded = [];
    protected $attributes = [
        'active' => 1,
    ];

    protected static $logName = 'promotions';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

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

    public function promotion_details()
    {
        return $this->hasMany('App\Model\PromotionDetails');
    }

    public function scopeonlyActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopegetDataByKeyword($query, $keyword)
    {
        return $query->where('name_th', 'like', "%$keyword%")
            ->orWhere('name_en', 'like', "%$keyword%");
    }
}
