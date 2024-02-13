<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_Player extends Model
{
    use HasFactory;

    protected $fillable= [
        'start_date',
        'end_date',
        'player_id',
        'program_id',
    ];


    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

}
