<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AutoFomatNumber extends Model
{
  protected $table = 'auto_format_number';
  protected $guarded = [];

  protected static $logName = 'auto_format_number';
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;

}
