<?php

namespace App\Http\Controllers\Trainer\Course;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trainer\Trait\TrainerTrait;
use App\Models\Course;
use App\Models\Player_Course;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use TrainerTrait;

    public function index(Request $request)
    {

        $trainerID = Auth::guard('trainer')->user()->id;
        $status = $request->input('status');


        if ($status == 0) {
            $trainerCourses = Course::with('class', 'trainer')->where('trainer_id', $trainerID)->where('status', '0')->get();
        } elseif ($status == 1) {
            $trainerCourses = Course::with('class', 'trainer')->where('trainer_id', $trainerID)->where('status', '1')->get();
        } else {
            $trainerCourses = Course::with('class', 'trainer')->where('trainer_id', $trainerID)->get();
        }
        $results = [];

        foreach ($trainerCourses as $trainerCourse) {
            $countPlayerCourse = Player_Course::where('course_id', $trainerCourse->id)->count();
            $courseResult = [
                'id' => $trainerCourse->id,
                'class_name' => $trainerCourse->class->name,
                'capacity' => $trainerCourse->capacity,
                'trainer_name' => $trainerCourse->trainer->first_name,
                'image_path' => $trainerCourse->class->image_path,
                'status' => $trainerCourse->status,
                'countPlayerCourse' => $countPlayerCourse,
                'day_times' => [],
            ];

            $dayTimeData = json_decode($trainerCourse->day_times, true);

            foreach ($dayTimeData as $dayId => $timeIds) {
                $dayName = DB::table('days')->where('id', $dayId)->value('name');
                $timeStarts = DB::table('times')->whereIn('id', $timeIds)->pluck('time_start');
                $timeEnds = DB::table('times')->whereIn('id', $timeIds)->pluck('time_end');
                $timeRanges = $timeStarts->zip($timeEnds)->map(function ($times) {
                    return $times[0] . ' TO ' . $times[1];
                });

                $courseResult['day_times'][$dayName] = $timeRanges->implode(', ');
            }

            $results[] = $courseResult;
        }

        return $this->Data_Trainer($results, 'Courses retrieved successfully', 200);
    }
}
