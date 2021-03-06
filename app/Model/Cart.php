<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\DB;

class Cart extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait;
    protected $table = 'cart';
    protected $guarded = [];

    protected static $logName = 'cart';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function product()
    {
        return $this->hasOne('App\Model\Products', 'id', 'products_id');
    }

    public function stocks()
    {
        return $this->hasMany('App\Model\Stocks', 'products_id', 'products_id')
            ->where('warehouses_id', config('global.warehouse'));
    }

    public function promotion_details()
    {
        return $this->hasMany('App\Model\PromotionDetails', 'products_id', 'products_id');
    }

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function scopeonlyActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopewithoutOrder($query)
    {
        return $query->whereNull('orders_id');
    }

    public function scopestockCheckAvailable($query, $warehouse = 1)
    {
        return $query->whereHas('stocks', function ($q) use ($warehouse) {
            $q->where('warehouses_id', $warehouse)
                ->whereRaw('quantity < cart.quantity');
        });
    }

    public function scopeonlyAvailable($query, $warehouse = 1)
    {
        return $query->whereHas('stocks', function ($q) use ($warehouse) {
            $q->where('warehouses_id', $warehouse)
                ->where('quantity', '>', 0);
        });
    }

    public function scopegetDataByKeyword($query, $request)
    {
        $keyword = $request->keyword;
        $active = $request->active;
        $recommend = $request->recommend;
        if ($keyword) {
            $query = $query->where('name_th', 'like', "%$keyword%")
                ->orWhere('name_en', 'like', "%$keyword%")
                ->orWhereHas('categories_name', function ($q1) use ($keyword) {
                    $q1->where('name_th', 'like', "%$keyword%")
                        ->orWhere('name_en', 'like', "%$keyword%");
                });
        }
        if ($active === "0" or $active === "1") {
            $query = $query->where('active', (int) $active);
        }
        if ($recommend === "1") {
            $query = $query->where('recommend', (int) $recommend);
        }
        return $query;
    }

    public function scopegetDataByCategory($query, $category)
    {
        $query = $query->whereIn('categories_id', $category);

        return $query;
    }

    public function scopegetDataByGrade($query, $grade)
    {
        $query = $query->whereIn('grades_id', $grade);

        return $query;
    }

    public function scopegetDataByPriceLength($query, $request)
    {
        $query = $query->whereBetween('price', [$request->start_price, $request->end_price])
            ->orWhereBetween('full_price', [$request->start_price, $request->end_price]);

        return $query;
    }
}
