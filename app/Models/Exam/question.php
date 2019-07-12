<?php

namespace App\Models\Exam;
//amespace App\Models\classes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam\examination;

class question extends Model 
{
     
     protected $primaryKey = 'question_id';
     public $incrementing = false;


    protected $guarded =[];

        public function examination()
        {
            return $this->belongsTo(examination::class,'exam_code','exam_id');
        }
        public function getRouteKeyName()
        {
        	 return 'question_id';
        }
  
}
