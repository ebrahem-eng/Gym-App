<?php

namespace App\Http\Controllers\Employe\Player;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    
    //عرض صفحة التأكد من حالة اللاعب
    public function check_status_show()
    {
        $players = Player::all();
        return view('Employe/Player/check_player_table' , compact('players'));
    }
}
