<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class PromotionDetails extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'promotion_details';
    protected $guarded = [];

    protected static $logName = 'promotion_details';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function promotions()
    {
        return $this->belongsTo('App\Model\Promotions', 'promotions_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo('App\Model\Products', 'products_id', 'id');
    }

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function scopegetDataByKeyword($query, $keyword)
    {
        return $query->where('name_th', 'like', "%$keyword%")
            ->orWhere('name_en', 'like', "%$keyword%");
    }
}
