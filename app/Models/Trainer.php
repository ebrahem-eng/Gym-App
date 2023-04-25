<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class Trainer extends Model
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;
    use SoftDeletes;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'age',
        'salary',
        'work_time_start',
        'work_time_end',
        'email',
        'password',
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //علاقة الصفوف مع المدربين 
    
    public function classes()
    {
        return $this->belongsToMany(ClassT::class , 'courses' , 'trainer_id' , 'class_id');
    }
}
