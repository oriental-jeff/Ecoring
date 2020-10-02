<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Orders extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'order';
    protected $guarded = [];

    protected static $logName = 'order';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

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
