<?php

namespace App\Models\faculty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class user_faculty_head extends Authenticatable implements JWTSubject
{
	use Notifiable;

    protected $guard = 'faculty_heads';
	protected $primaryKey = 'faculty_head_id';
    protected $guarded =[];

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
