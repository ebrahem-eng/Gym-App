<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'video',
        'course_id',
        'created_by',
    ];

    //علاقة التمرين مع المدرب 

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'created_by');
    }

    //علاقة التمرين مع الكورس
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

     //علاقة التمرين مع تمارين البرنامج
    
     public function exerciseProgram()
     {
         return $this->hasMany(exerciseProgram::class, 'exerciseID');
     }
}
