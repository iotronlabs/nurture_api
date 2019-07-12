<?php

namespace App\Models\Department;
//amespace App\Models\classes;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

//use Tymon\JWTAuth\Contracts\JWTSubject;

class department extends Model 
{
     use Notifiable;
      //protected $primaryKey = '';


    protected $guarded =[
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function stream()
    {
      return $this->belongsTo(stream::classs,department_code,department_code);
    }
}
