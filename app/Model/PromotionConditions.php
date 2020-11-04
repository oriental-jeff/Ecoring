<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class PromotionConditions extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'promotion_conditions';
    protected $guarded = [];

    protected static $logName = 'promotion_conditions';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function promotions()
    {
        return $this->belongsTo('App\Model\Promotions', 'promotions_id', 'id');
    }

    public function promotion_types()
    {
        return $this->belongsTo('App\Model\PromotionTypes', 'promotion_types_id', 'id');
    }

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function promotion_details()
    {
        return $this->hasMany('App\Model\PromotionDetails');
    }

    // public function gettypeAttribute($attributes)
    // {
    //     return [
    //         0 => 'ขั้นบันได',
    //         1 => 'ส่วนลด',
    //         2 => 'เมื่อซื้อครบ',
    //     ][$attributes];
    // }
}
