<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles , SoftDeletes ; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'age',
        'gender',
        'img',
        'phone',
        'salary_id',
        'address',
    ];

    //علاقة المدير مع الرواتب
    
    public function salary()
    {
        return $this->belongsTo(Salary::class , 'salary_id');
    }
    

    //علاقة المدير مع الموظفين

    public function employes()
    {
        return $this->hasMany(Employe::class,'created_by');
    }

     //علاقة المدير مع الصفوف
    
     public function classes()
     {
         return $this->hasMany(ClassT::class,'created_by');
     }

      //علاقة المدير مع الكورسات
    
      public function courses()
      {
          return $this->hasMany(Course::class,'created_by');
      }

         //علاقة المدير مع المدربين 

    public function trainers()
    {
        return $this->hasMany(Trainer::class,'created_by');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
