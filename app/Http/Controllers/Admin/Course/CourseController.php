<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\ClassT;
use App\Models\Course;
use App\Models\Day;
use App\Models\Time;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    
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
    return view('Admin/Course/index' , compact('results'));


    }

    public function create()
    {
        $classes = ClassT::all();
        $trainers = Trainer::all();
        $days = Day::all();
        return view('Admin/Course/create', compact('classes', 'trainers' ,'days'));
    }

    public function create_2(Request $request)

    { 
        $class_id = $request->input('class');
        $trainer_id = $request->input('trainer');
        $day_ids = $request->input('day');
        $day_details = Day::whereIn('id', $day_ids)->get(['id','name'])->toArray();
        $times = Time::all();
        return view('Admin/Course/create2' , compact('day_details' , 'times' ,'trainer_id' , 'class_id'));
    }

    public function store(Request $request)
    {
         $trainer = Trainer::find($request->input('trainer_id'));
         $class_id = $request->input('class_id');
         $day_time = $request->input('day_time');
        
         $classData = [
            'day_times' => json_encode($day_time)
        ];
        
        $trainer->classes()->attach($class_id, $classData);

        return redirect()->route('admin.course.index')->with('message_success_store','Course Added Successfully');
      
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->back()->with('message_success_delete', 'Course Deleted Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_delete', 'Deleting error please try agin!');
        }
    }

    public function Archive()
    {
        try {
            $deleted_courses = [];
            $courses = DB::select("
            SELECT courses.id AS course_id, courses.status AS status,
            trainers.first_name AS trainer_name, class_t_s.name AS class_name,
            courses.day_times AS day_time
            FROM courses 
            INNER JOIN trainers ON courses.trainer_id = trainers.id 
            INNER JOIN class_t_s ON courses.class_id = class_t_s.id
            WHERE courses.deleted_at IS NOT NULL
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
            
                $deleted_courses[] = $courseResult;
            }
            
            return view('Admin/Course/Archive' , compact('deleted_courses'));

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    public function restore($id)
    {
        try {
            Course::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success_restore', 'Course Restored Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }

    public function force_delete($id)
    {
        try {
            Course::withTrashed()->where('id', $id)->forcedelete();
            return redirect()->back()->with('message_success_forcedelete', 'Course deleted Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }

}
