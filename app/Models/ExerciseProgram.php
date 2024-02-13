<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'numberOFSets',
        'resetBetweenSets',
        'dublicatesInSets',
        'exerciseArrangement',
        'exerciseSystem',
        'programID',
        'exerciseID',
    ];


    //علاقة تمارين البرنامج مع التمرين

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exerciseID');
    }

       //علاقة تمارين البرنامج مع البرنامج

       public function program()
       {
           return $this->belongsTo(Program::class, 'programID');
       }
}
