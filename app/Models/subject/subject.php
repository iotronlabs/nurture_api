<?php

namespace App\Models\subject;
//amespace App\Models\classes;

use App\Models\Exam\examination;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public function exam()
    {
    	return $this->hasMany(examination::class,'subject_name','sub_name');
    }

    public function getRouteKeyName()
    {
    	return $this->id;
    }


}
