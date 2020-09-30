<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Tags extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'tags';
    protected $guarded = [];

    protected static $logName = 'tags';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function products()
    {
        return $this->hasMany('App\Model\Products', 'tags_id', 'id');
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
