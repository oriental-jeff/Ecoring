<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class StatusConfig extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'status_config';
    protected $guarded = [];

    protected static $logName = 'status_config';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
}
