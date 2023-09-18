<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory , SoftDeletes;
    
    protected $fillable = [
        'day_times',
        'class_id',
        'trainer_id',
        'created_by',
        'capacity',
        'status',
    ];

      //علاقة الكورس مع الحسومات

      public function offers()
      {
          return $this->hasMany(Offer::class, 'course_id');
      }

      //علاقة الكورس مع اللاعبين
      
      public function players()
      {
          return $this->hasMany(Player_Course::class, 'course_id');
      }
     

      //علاقة الكورس مع الصفوف
      public function class()
      {
          return $this->belongsTo(ClassT::class, 'class_id');
      }
  
      //علاقة الكورس مع المدربين
      public function trainer()
      {
          return $this->belongsTo(Trainer::class, 'trainer_id');
      }


}
