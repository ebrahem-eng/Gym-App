<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'price_befor_discount',
        'discount_value',
        'price_after_discount',
        'course_id',
        'created_by',
    ];

    //علاقة الحسومات مع الموظفين

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'created_by');
    }

     //علاقة الحسومات مع الموظفين
    
     public function course()
     {
         return $this->belongsTo(Course::class, 'course_id');
     }
}
