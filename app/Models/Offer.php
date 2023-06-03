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
    ];
}
