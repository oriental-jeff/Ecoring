<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ProductTags extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'product_tags';
    protected $guarded = [];

    protected static $logName = 'product_tags';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function tags()
    {
        return $this->hasOne('App\Model\Tags', 'id', 'tags_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Products');
    }

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
}
