<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player_Course extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
        'duration',
        'status',
        'course_id',
        'player_id',
        'course_price',
        'total_amount',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
