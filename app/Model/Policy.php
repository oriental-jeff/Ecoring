<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Policy extends Model implements HasMedia
{
  use LogsActivity, HasMediaTrait;
  protected $table = 'policy';
  protected $guarded = [];

  protected static $logName = 'policy';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

}
