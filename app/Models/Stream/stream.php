<?php

namespace App\Models\Stream;
//amespace App\Models\classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


//use Tymon\JWTAuth\Contracts\JWTSubject;

class stream extends Model
{
    use Notifiable;
    // protected $primaryKey = 'topic_id';


    protected $guarded =[
        ];

    public function subject()
    {
      return $this->hasMany(subject::class,'sub_stream','stream_name');
    }

    public function department()
    {
      return $this->hasMany(department::class,department_code,department_code);
    }
}
      
