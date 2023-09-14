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
    use HasApiTokens, HasFactory, Notifiable , HasRoles , SoftDeletes;
      
    
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
    
        //علاقة الصفوف مع المدربين 
    
        public function classes()
        {
            return $this->belongsToMany(ClassT::class , 'courses' , 'trainer_id' , 'class_id');
        }

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
   
    public function getJWTCustomClaims() {
        return [];
    } 


}
