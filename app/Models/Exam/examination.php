<?php

namespace App\Models\Exam;

use App\Models\Exam\question;
use App\Models\teacher\user_teacher;
use Illuminate\Database\Eloquent\Model;


class examination extends Model
{
    
    protected $primaryKey = 'exam_code';
    public $incrementing = false;

    protected $guarded =[];

    public function questions()
    {
        return $this->hasMany(question::class,'exam_id','exam_code');
    }

  
    public function getRouteKeyName()
    {

    	return 'exam_code';
    }

    public function teacher()
    {
    	return $this->belongsTo(user_teacher::class,'teacher_id_created','t_id');
    }

    public function students()
    {
        return $this->belongsTo('user_student::class', 'class_id', 'class_id');
    }

  
    
    
}
