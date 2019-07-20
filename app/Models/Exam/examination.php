<?php

namespace App\Models\Exam;

use App\Models\Exam\question;

use Illuminate\Database\Eloquent\Model;


class examination extends Model
{
    
    protected $primaryKey = 'id';
    

    protected $guarded =[];

    public function questions()
    {
        return $this->hasMany(question::class,'exam_id','id');
    }

  

    public function students()
    {
    	return $this->belongsTo(user_student::class,'s_course','course_name');
    }

    public function show_rule()
    {
        return $this->hasOne(examination::class);
    }

    // public function students()
    // {
    //     return $this->belongsTo('user_student::class', 'class_id', 'class_id');
    // }

  
    
    
}
