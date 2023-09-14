<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
    ];

    //علاقة الرواتب مع المدير
    
    public function admins()
    {
        return $this->hasMany(Admin::class,'salary_id');
    }

     //علاقة الرواتب مع الموظفين
    
     public function employes()
     {
         return $this->hasMany(Employe::class,'salary_id');
     }
}
