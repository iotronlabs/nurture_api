<?php

namespace App\Models\forum;

use Illuminate\Database\Eloquent\Model;

class forum_channel extends Model
{
    public function threads()
    {
 
      return $this->hasMany(forum_thread::class);

    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
