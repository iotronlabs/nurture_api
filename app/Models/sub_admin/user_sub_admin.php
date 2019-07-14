<?php

namespace App\Models\sub_admin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class user_sub_admin extends Authenticatable implements JWTSubject
{
   protected $primaryKey = 'sub_admin_id';
   protected $guarded = [];

   use Notifiable;

    protected $guard = 'sub_admin';
    
    protected $fillable = [
        'name', 'email', 'password'
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
       // 'email_verified_at' => 'datetime',
    ];
    
    
    public function getJWTIdentifier()
    {
      return $this->getkey();
    }
    public function getJWTCustomClaims()
    {
      return [];

    }

}

