<?php

namespace App\Models\classes;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Tymon\JWTAuth\Contracts\JWTSubject;

class table_classes extends Authenticatable 
{
     use Notifiable;


    protected $guarded =[
        'class_id'];
         protected $primaryKey = 'class_id';


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
      //  'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'class_centre_name';
    }

    public function getJWTIdentifier()
    {
      return $this->getkey();
    }
    public function getJWTCustomClaims()
    {
      return [];

    }
}
