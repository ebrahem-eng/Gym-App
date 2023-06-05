<?php

namespace App\Http\Controllers\Trainer\Course;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trainer\Trait\TrainerTrait;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use TrainerTrait;

    public function index()
    {
        
        $results = [];
        $courses = DB::select("
SELECT courses.id AS course_id , courses.status AS status ,
trainers.first_name AS trainer_name, class_t_s.name AS class_name ,
courses.day_times AS day_time
FROM courses 
INNER JOIN trainers ON courses.trainer_id = trainers.id 
INNER JOIN class_t_s ON courses.class_id = class_t_s.id
WHERE courses.deleted_at IS NULL
");


        foreach ($courses as $course) {
            $day_time = json_decode($course->day_time, true);
            $courseResult = [
                'id' => $course->course_id,
                'status' => $course->status,
                'trainer_name' => $course->trainer_name,
                'class_name' => $course->class_name,
                'day_times' => [],
            ];

            foreach ($day_time as $dayId => $timeIds) {
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
       
        return $this->Data_Trainer($results,'course get successfully',200);
    }
}
