<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employe extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles , SoftDeletes;
    
    protected $guard = 'employe';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'age',
        'email',
        'password',
        'status',
        'address',
        'img',
        'gender',
        'work_time_id',
        'created_by',
        'salary_id',
    ];

    // علاقة الموظف مع المدير
    public function admin()
    {
        return $this->belongsTo(Admin::class , 'created_by');
    }

     //علاقة الموظف مع الرواتب
    
     public function salary()
     {
         return $this->belongsTo(Salary::class , 'salary_id');
     }

      //علاقة الموظف مع وقت العمل
    
      public function time()
      {
          return $this->belongsTo(Time::class , 'work_time_id');
      }

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
