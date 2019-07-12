<?php

namespace App\Models\student;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Exam\examination;

use Tymon\JWTAuth\Contracts\JWTSubject;

class user_student extends Authenticatable implements JWTSubject
{
    

    // protected $guard = 'students';
    protected $primaryKey = 's_id';
    
    protected $guarded =[];

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
    
    
    public function getJWTIdentifier()
    {
      return $this->getkey();
    }
    public function getJWTCustomClaims()
    {
      return [];

    }

    
    // public function exams()
    // {
    //     return $this->hasMany(examination::class, 'class_id','class_id');
    // }
}
