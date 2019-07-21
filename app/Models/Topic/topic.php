<?php

namespace App\Models\Topic;
//amespace App\Models\classes;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


//use Tymon\JWTAuth\Contracts\JWTSubject;

class topic extends Authenticatable 
{
     use Notifiable;
      protected $primaryKey = 'topic_id';


    protected $guarded =[
        ];

   
}
