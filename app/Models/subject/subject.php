<?php

namespace App\Models\subject;
//amespace App\Models\classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//  use App\Models\subject\subject;
// use Illuminate\Database\Eloquent\Model;

//use Tymon\JWTAuth\Contracts\JWTSubject;

class subject extends Model 
{
     use Notifiable;
     // protected $primaryKey = 'subject_id';


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

    public function stream()
    {
        return $this->belongsTo(stream::class,'stream_name', 'sub_stream');
    }


}
