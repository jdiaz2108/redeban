<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email', 'password',
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

    public function userData()
    {
        return $this->hasOne('App\Models\UserData');
    }

    /* return an atribute in boolean variable if the user has updated data accessing with $user->updated */
    public function getUpdatedAttribute()
    {
        return ($this->userData) ? true : false ;
    }

    public function points()
    {
        return $this->hasMany('App\Models\Point');
    }

    /* return the sum of points in value column 'value' accessing with $user->sumpoints */
    public function getSumPointsAttribute()
    {
        return $this->points()->sum('value');
    }

    public function redeemValidate()
    {
        return $this->hasMany('App\Models\redeemValidateMail');
    }

    public function getActiveRedeemAttribute()
    {
        return $this->redeemValidate()->latest()->first();
    }

}
