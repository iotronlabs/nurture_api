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

    

    public function stream()
    {
        return $this->belongsTo(stream::class,'stream_name', 'sub_stream');
    }


}
