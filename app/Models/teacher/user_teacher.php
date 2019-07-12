<?php

namespace App\Models\teacher;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Exam\examination;

use Tymon\JWTAuth\Contracts\JWTSubject;

class user_teacher extends Authenticatable implements JWTSubject
{
     use Notifiable;
     protected $guard ='user_teachers';
     protected $primaryKey = 't_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password','gender','contact','u_id','t_ref_id','status',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected  $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
//'email_verified_at' => 'datetime',
    ];
    
    
    public function getJWTIdentifier()
    {
      return $this->getkey();
    }
    public function getJWTCustomClaims()
    {
      return [];

    }

    public function exams()
    {
        return $this->hasMany(examination::class, 'teacher_id_created','t_id');
    }

}
