<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'number_program',
        'status',
        'course_id',
        'created_by',
    ];

    //علاقة البرنامج مع الكورس 

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    //علاقة البرنامج مع المدرب 

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'created_by');
    }

    //علاقة البرنامج مع اللاعب
    
    public function programs_player()
    {
        return $this->hasMany(Program_Player::class, 'program_id');
    }

      //علاقة البرنامج مع تمارين البرنامج
    
      public function programExercise()
      {
          return $this->hasMany(ExerciseProgram::class, 'programID');
      }
}
