<?php

namespace App\Models\forum;

use App\Forum\Filters\ThreadFilters;
use App\Models\forum\forum_reply;
use App\Models\forum\forum_channel;
use App\Models\teacher\user_teacher;
use Illuminate\Database\Eloquent\Model;

class forum_thread extends Model
{
    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount' , function($builder)
        {
              
              $builder->withCount('replies');
           
        });
    }

    public function path()
    {
    	return '/api/forum/threads/'.$this->id;
    }

    public function replies()
    {
 
      return $this->hasMany(forum_reply::class);

    }

    public function addReply($reply)
    {

    	$this->replies()->create($reply);
    }

      public function creator()
    {
        return $this->belongsTo(user_teacher::class, 'user_id' , 't_id');
    }


    public function channel()
    {
        return $this->belongsTo(forum_channel::class);
    }

    public function scopeFilter($query,ThreadFilters $filters)
    {

        return $filters->apply($query);
    }
}


