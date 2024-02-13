<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Trainer extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;


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

    //علاقة المدرب مع الكورسات

    public function courses()
    {
        return $this->hasMany(Course::class, 'trainer_id');
    }

    // علاقة المدرب مع المدير
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    //علاقة المدرب مع الرواتب

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id');
    }

    //علاقة المدرب مع وقت العمل

    public function time()
    {
        return $this->belongsTo(Time::class, 'work_time_id');
    }

      //علاقة المدرب مع البرامج

      public function programs()
      {
          return $this->hasMany(Program::class, 'created_by');
      }

    //علاقة المدرب مع التمارين 

      public function exercises()
      {
          return $this->hasMany(Exercise::class, 'created_by');
      }


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
