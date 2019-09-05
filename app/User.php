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

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }

    public function points()
    {
        return $this->hasMany('App\Models\Point');
    }

    public function redeemValidate()
    {
        return $this->hasMany('App\Models\redeemValidateMail');
    }

    public function fulfillment()
    {
        return $this->hasMany('App\Models\Fulfillment')->latest()->first();
    }

    public function fulfillmentAll()
    {
        return $this->hasMany('App\Models\Fulfillment')->latest()->get();
    }

    /* return an atribute in boolean variable if the user has updated data accessing with $user->updated */
    public function getUpdatedAttribute()
    {
        return ($this->userData) ? true : false ;
    }
    /* return the sum of points in value column 'value' accessing with $user->sumpoints */
    public function getSumPointsAttribute()
    {
        return $this->points()->sum('value');
    }

    public function getActiveRedeemAttribute()
    {
        return $this->redeemValidate()->latest()->first();
    }

    public function getFulfillmentGoalAttribute()
    {
        return ($this->fulfillment()['goal']) ? $this->fulfillment()['goal'] : 0 ;
    }

    public function categoryImage($category_id)
    {
        switch ($category_id) {
          case '1':
            $image = "images/oro.png";
            break;
          case '2':
            $image = "images/plata.png";
            break;

          default:
            $image = "images/bronce.png";
            break;
        }

        return $image;
    }

  }
