<?php

namespace App\Http\Controllers\Employe\RegisterPlayer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Offer;
use App\Models\Player;
use App\Models\Player_Course;
use Illuminate\Http\Request;

class RegisterPlayerController extends Controller
{

    //عرض صفحة تسجيل لاعب في كورس 

    public function registerNewPlayerCreate()
    {
        $players = Player::all();
        $courses = Course::with('class', 'trainer', 'offers')->get();

        foreach ($courses as $course) {

            $count_in_course = Player_Course::where('course_id', $course->id)->where('status', '1')->count();

            $courseCounts[$course->id] = $count_in_course;
        }

        return view('Employe.RegisterPlayer.registerNewPlayer', compact('players', 'courses', 'courseCounts'));
    }

    //تسجيل لاعب في كورس معين 

    public function registerNewPlayerStore(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $duration = $request->input('duration');
        $current_date = now()->toDateString();
        $course_id = $request->input('course_id');
        $player_id = $request->input('player_id');
        $check_player_course_exists = Player_Course::where('course_id', $course_id)->where('player_id', $player_id)->count();
        $count_in_course = Player_Course::where('course_id', $course_id)->where('status', '1')->count();
        $course_capacity = Course::where('id', $course_id)->value('capacity');
        $course_price = Offer::where('course_id', $course_id)->value('price_after_discount');
        $total_amount = $course_price * $duration;

        if ($check_player_course_exists > 0) {
            return redirect()->back()->with('message_err', 'Player Already Register In This Course');
        } else {
            if ($count_in_course == $course_capacity) {
                return redirect()->back()->with('message_err', 'The Course Is Full Choose Another Course');
            } else {
                if ($start_date < $current_date && $end_date < $current_date) {
                    $status = 0;
                } else if ($start_date < $current_date && $end_date >= $current_date) {
                    $status = 1;
                } elseif ($start_date === $current_date) {
                    $status = 1;
                }
                if($course_price == null)
                {
                    return redirect()->back()->with('message_err', 'Please Make Offer For This Course To Select Price'); 
                }else
                {
                    Player_Course::create([
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'duration' => $duration,
                        'status' => $status,
                        'course_price' => $course_price,
                        'total_amount' => $total_amount,
                        'course_id' => $course_id,
                        'player_id' => $player_id,
                    ]);
    
                    return redirect()->back()->with('message_success', 'Player Register Successfully');
                }

            }
        }
    }
}
