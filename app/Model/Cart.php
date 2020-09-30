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

    // public function promotions()
    // {
    //     return $this->hasOne('App\Model\Promotions', 'promotions_id', 'promotions_id')
    //         ->where('start_at', '<=', date('Y-m-d'))
    //         ->where('end_at', '>=', date('Y-m-d'));
    // }

    public function update_name()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function scopepriceCondition($query)
    {
        return $query
            ->whereHas('product')
            ->whereHas('stocks')
            ->whereHas('promotion_details', function ($q) {
                $q->whereHas('promotionPrice');
            });
        // return $query
        //     ->whereHas('product')
        //     ->whereHas('stocks')
        //     ->leftJoin('promotion_details as pmtdt', 'pmtdt.products_id', '=', 'cart.products_id')
        //     ->leftJoin('promotions as pmt', function ($join) {
        //         $join->on('pmt.id', '=', 'pmtdt.promotions_id')
        //             ->where('start_at', '<=', date('Y-m-d'))
        //             ->where('end_at', '>=', date('Y-m-d'));
        //     });
        // ->whereHas('promotion_details', function ($q) {
        //     $q->leftJoin('promotions as pmt', function ($join) {
        //         $join->on('pmt.id', '=', 'promotion_details.promotions_id')
        //             ->where('start_at', '<=', date('Y-m-d'))
        //             ->where('end_at', '>=', date('Y-m-d'));
        //     });
        // });
        // return $query
        //     // ->leftJoin('products as pd', 'pd.id', '=', 'cart.products_id')
        //     ->whereHas('product')
        //     ->leftJoin('stocks as stk', function ($join) {
        //         $join->on('stk.products_id', '=', 'cart.products_id');
        //         $join->where('warehouses_id', config('global.warehouse'));
        //     })
        //     ->leftJoin('promotion_details as pmtdt', 'pmtdt.products_id', '=', 'cart.products_id')
        //     ->leftJoin('promotions as pmt', function ($join) {
        //         $join->on('pmt.id', '=', 'pmtdt.promotions_id')
        //             ->where('start_at', '<=', date('Y-m-d'))
        //             ->where('end_at', '>=', date('Y-m-d'));
        //     });
        // ->selectRaw('cart.id as id, IF(pmtdt.price, pmtdt.price, pd.price) as real_price, stk.quantity as stock_qty');

        // return $query->whereHas('product', function ($q) {
        //     $q->whereHas('promotions', function ($q1) {
        //         $q1->where('start_at', '<=', date('Y-m-d'))
        //             ->where('end_end', '>=', date('Y-m-d'));
        //     });
        // });

        // return $query->whereHas('promotions', function ($q) {
        //     $q->where('start_at', '<=', date('Y-m-d'))
        //         ->where('end_end', '>=', date('Y-m-d'));
        // });

        // return $query->whereHas('promotion_details', function ($q) {
        //     $q->select('price');
        // })->whereHas('promotions', function ($q) {
        //     $q->where('warehouses_id', 2)
        //         ->whereRaw('quantity < cart.quantity');
        // });
    }

    public function scopeonlyActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopestockCheckAvailable($query, $warehouse = 1)
    {
        return $query->whereHas('promotion_details', function ($q) use ($warehouse) {
            $q->select('price')->where('warehouses_id', $warehouse)
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
