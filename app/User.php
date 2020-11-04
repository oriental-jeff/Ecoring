<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles, LogsActivity, SoftDeletes;

    protected static $logName = 'user';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'created_by', 'updated_by', 'first_name', 'last_name', 'guest', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_updates()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function social_account()
    {
        return $this->hasMany('App\SocialAccount', 'user_id', 'id');
    }

    public function profiles()
    {
        return $this->hasOne('App\Model\UserProfile', 'user_id', 'id');
    }

    public function address_deliveries_default()
    {
        return $this->hasOne('App\Model\UserAddressDelivery', 'user_id', 'id')->where('default', 1);
    }

    public function address_deliveries()
    {
        return $this->hasMany('App\Model\UserAddressDelivery', 'user_id', 'id');
    }

    // SCOPES
    public function scopegetDataByKeyword($query, $keyword)
    {
        return $query->where('first_name', 'like', "%$keyword%");
    }

    public function scopeignoreSuperAdmin($query)
    {
        return $query->where('first_name', 'not like', "%SuperAdmin%");
    }

    public function scopeReportGetDataByKeyword($query, $keyword)
    {
        return $query->where('guest', 1)
            ->where('first_name', 'like', "%{$keyword}%")
            ->orWhere('last_name', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%")
            ->orWhereHas('profiles', function ($qry) use ($keyword) {
                $qry->where('telephone', 'like', "%{$keyword}%");
            });
    }

    // GET SPECIFIC
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /*public function getActiveAttribute($attributes) {
    return  [
    1 => 'Active' ,
    0 =>'Inactive'
    ][$attributes];
    }*/

    public function isActive()
    {
        return $this->active === 1;
    }

}
