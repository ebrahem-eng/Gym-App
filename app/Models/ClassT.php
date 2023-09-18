<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassT extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image_path',
        'created_by',
    ];

    //علاقة الصفوف مع الكورسات 
    
    public function courses()
    {
        return $this->hasMany(Course::class, 'class_id');
    }

       // علاقة الصف مع المدير
       public function admin()
       {
           return $this->belongsTo(Admin::class , 'created_by');
       }
}
