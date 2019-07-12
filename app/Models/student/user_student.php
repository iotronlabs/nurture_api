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
     use Notifiable;


    protected $guard = 'students';
    protected $primaryKey = 's_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //      's_id','t_ref_id','s_fname','s_mname','s_surname','s_email','s_gender','s_dob','s_age','s_nationality','s_address','s_address_pin'.'s_address_state','guardian_fname','guardian_mname','guardian_surname','guardian_email','guardian_address','
    //     guardian_pin','guardian_state',
    //     's_password','class_id','status','s_authentication','guardian_contact','s_contact',
    // ];

    protected $guarded =[
        's_id'];

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

    
    public function exams()
    {
        return $this->hasMany(examination::class, 'class_id','class_id');
    }
}
