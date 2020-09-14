<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Stocks extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'stocks';
    protected $guarded = [];

    protected static $logName = 'stocks';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function product()
    {
        return $this->hasOne('App\Model\Products', 'id', 'products_id');
    }

    public function warehouse()
    {
        return $this->hasOne('App\Model\Warehouses', 'id', 'warehouses_id');
    }

    public function scopegetDataByKeyword($query, $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $query = $query
                ->whereHas('product', function ($q1) use ($keyword) {
                    $q1->where('name_th', 'like', "%$keyword%")
                        ->orWhere('name_en', 'like', "%$keyword%");
                })
                ->orWhereHas('warehouse', function ($q2) use ($keyword) {
                    $q2->where('name', 'like', "%$keyword%");
                });
        }
        return $query;
    }
}
