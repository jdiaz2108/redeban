<?php

namespace App;

use App\Http\Controllers\MailjetController;
use App\Models\Shop;
use App\Models\Category;
use App\Models\AccessLog;
use App\Models\City;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identification', 'name', 'email', 'password',
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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }

    public function accessLogs()
    {
        return $this->hasMany('App\Models\AccessLog');
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function pointShop()
    {
        return $this->shops()->whereCode(session('current_shop'))->first();
    }

    /* return an atribute in boolean variable if the user has updated data accessing with $user->updated */
    public function getUpdatedAttribute()
    {
        return ($this->userData) ? true : false ;
    }

    public function getHasPointsUpdatedDataAttribute()
    {
        $this->shops()->filter(function ($value, $key) {
            return $value > 2;
        });
        return ($this->userData) ? true : false ;
    }
    /* return the sum of points in value column 'value' accessing with $user->sumpoints */
    public function getPointsAttribute()
    {
        return ($this->pointShop()) ? $this->pointShop()->totalpoints : null ;
    }

    public function getChangedPasswordAttribute()
    {
        return ($this->accessLogs()->whereEvent('Cambio contraseña')->first()) ? true : false;
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

    public function scopeFindUser($query, $name)
    {
        return $query->where('name_company', 'LIKE', "%$name%")->orWhere('identification', 'LIKE', "%$name%");
    }

    public static function reportCategories()
    {
      $categories = Category::get();
      $users_all = AccessLog::where('event','Inicio de sesión')->count();
      $rows = [];
      $users_count = [];

      foreach ($categories as $value) {
         $count = User::where('category_id',$value->id)->count();
         array_push($rows,$value->name);
         array_push($users_count,$count);
      }

      //Deleting the first category "Oro"
      array_shift($rows);
      array_shift($users_count);

      $users_categories = ["rows"=>$rows,"users_count"=>$users_count];

      return $users_categories;
    }

    public function sendPasswordResetNotification($token)
    {
        $url = url('/').'/password/reset/'.$token;
  		$name = $this->name_company;

  		$template = view('emails.restore-password', compact('url', 'name'))->render();

  		$data['user_email'] = $this->email;
  		$data['user_name'] = $name;
  		$data['email_subject'] = $name.', has solicitado cambio de contraseña';
  		$data['email_description'] = 'Restaurar acceso a la platafoma Vive+';
  		$data['email_template'] = $template;

          $res = MailjetController::sendEmail($data);
      //dd($res);
    }

    public function HasUpdateDataPointsFun()
    {
        return $this->shops()->get()->map(function($value) {
                if ($value['PointsByUpdatingData']) {
                    return true;
                };
            })->filter()->values()->isNotEmpty();
    }

    public function getHasUpdateDataPointsAttribute()
    {
        return ($this->HasUpdateDataPointsFun()) ? true : false ;
    }

    public function getPointsUpdateDataAttribute()
    {
        return $this->category()->first()->points_update_data;
    }

    protected $with = ['shops'];


  }
