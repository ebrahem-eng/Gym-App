<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $fillable =[
        'time_start',
        'time_end',
    ];

    //علاقة وقت العمل مع الموظفين
    
    public function employes()
    {
        return $this->hasMany(Employe::class,'work_time_id');
    }
}
