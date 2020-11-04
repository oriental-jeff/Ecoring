<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PromotionTypes extends Model
{
    use LogsActivity;
    protected $table = 'promotion_types';
    protected $guarded = [];

    protected static $logName = 'promotion_types';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
}
