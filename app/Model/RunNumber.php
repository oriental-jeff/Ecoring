<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

class RunNumber extends Model
{
    protected $table = 'auto_format_number';
    protected $guarded = [];

    protected static $logName = 'auto_format_number';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public $timestamps = true;
}
