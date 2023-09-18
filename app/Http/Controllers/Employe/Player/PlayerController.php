<?php

namespace App\Http\Controllers\Employe\Player;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Offer;
use App\Models\Player;
use App\Models\Player_Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{

    //عرض صفحة التأكد من حالة اللاعب
    public function check_status_show()
    {
        try {
            $players = Player::all();
            return view('Employe/Player/check_player_table', compact('players'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //احضار الكورسات المسجل بها لاعب معين 

    public function player_course_details($id)
    {

        $playerCourses = Player_Course::with('player', 'course')->where('player_id', $id)->get();
        $courseResults = [];
        foreach ($playerCourses as $playerCourse) {
            $day_time = json_decode($playerCourse->course->day_times, true);

            foreach ($day_time as $dayId => $timeIds) {
                $dayName = DB::table('days')->where('id', $dayId)->value('name');

                $timeStarts = DB::table('times')->whereIn('id', $timeIds)->pluck('time_start');
                $timeEnds = DB::table('times')->whereIn('id', $timeIds)->pluck('time_end');

                $timeRanges = $timeStarts->zip($timeEnds)->map(function ($times) {
                    return $times[0] . ' TO ' . $times[1];
                });


                $courseResults[$playerCourse->course->id]['day_times'][$dayName] = $timeRanges->implode(', ');
            }
        }

        return view('Employe.Player.showPlayerCourses', compact('playerCourses', 'courseResults'));
    }

    //عرض صفحة تجديد الاشتراك

    public function player_course_renewal_edit($id)
    {
        $player_courses = Player_Course::with('player', 'course')->where('id', $id)->get();
        $current_date = now()->toDateString();
        foreach ($player_courses as $player_course) {
            $end_date_register = $player_course->end_date;
            $courses = Course::with('class', 'trainer', 'offers')->where('id', $player_course->course_id)->get();
        }

        foreach ($courses as $course) {

            $count_in_course = Player_Course::where('course_id', $course->id)->where('status', '1')->count();
        }

        if ($end_date_register >= $current_date) {
            return redirect()->back()->with('message_err', 'Register Is Still Active And You Cannot Renew It');
        } else {
            return view('Employe.Player.renewalPlayerRegister', compact('player_courses', 'courses', 'count_in_course'));
        }
    }

    //تخزين تجديد الاشتراك في قاعدة البيانات
    public function player_course_renewal_store(Request $request, $id)
    {
        $player_course = Player_Course::findOrfail($id);
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $duration = $request->input('duration');
        $current_date = now()->toDateString();
        $course_id = $request->input('course_id');
        $course_price = Offer::where('course_id', $course_id)->value('price_after_discount');
        $total_amount = $course_price * $duration;

        $status = 0;

        if ($start_date < $current_date && $end_date < $current_date) {
            $status = 0;
        } else if ($start_date < $current_date && $end_date >= $current_date) {
            $status = 1;
        } elseif ($start_date === $current_date) {
            $status = 1;
        }

        $player_course->update([
            'start_date' => $start_date,
            'end_date' => $end_date,
            'duration' => $duration,
            'course_price' => $course_price,
            'total_amount' => $total_amount,
            'status' => $status,
        ]);

        return redirect()->route('employe.check.player.status')->with('message_success', 'Register Renewal Successfully');
    }


    //الغاء اشتراك لاعب في كورس 

    public function player_course_unregister($id)
    {

        $player_course = Player_Course::findOrfail($id);
        if ($player_course) {
            $player_course->forceDelete();
            return redirect()->back()->with('message_success', 'Player UnRegisterd Successfully');
        } else {
            return redirect()->back()->with('message_err', 'Player Course Not Found');
        }
    }
}
