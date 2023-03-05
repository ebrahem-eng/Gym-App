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
        'class_time_start',
        'class_time_end',
        'day',
    ];
}
