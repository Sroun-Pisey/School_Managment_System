<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function discount(){
        return $this->belongsTo(DiscountStudent::class,'id','assign_student_id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function student_year(){
        return $this->belongsTo(StudentYear::class,'year_id','id');
    }

    public function subject(){
        return $this->belongsTo(SchoolSubject::class,'subject_id','id');
    }
    
    public function study_time(){
        return $this->belongsTo(StudyTime::class,'study_time_id','id');
    }

    public function study_type(){
        return $this->belongsTo(FeeCategory::class,'study_type_id','id');
    }

}
