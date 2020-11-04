<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PromotionConditionDetails extends Model
{
    use LogsActivity;
    protected $table = 'promotion_condition_details';
    protected $guarded = [];

    protected static $logName = 'promotion_condition_details';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
}
