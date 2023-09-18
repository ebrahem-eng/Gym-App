<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\ClassT;
use App\Models\Course;
use App\Models\Day;
use App\Models\Time;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CourseController extends Controller
{

    //عرض صفحة الكورسات 

    public function index()
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Courses Table');
            if ($check) {

                $results = [];
                $courses = DB::select("
    SELECT courses.id AS course_id , courses.status AS status ,
    courses.capacity AS capacity , courses.created_by AS created_by,
    courses.created_at AS created_at,
    trainers.first_name AS trainer_name, class_t_s.name AS class_name ,
    courses.day_times AS day_time, admins.name AS admin_name
    FROM courses 
    INNER JOIN trainers ON courses.trainer_id = trainers.id 
    INNER JOIN class_t_s ON courses.class_id = class_t_s.id
    INNER JOIN admins ON courses.created_by = admins.id
    WHERE courses.deleted_at IS NULL
");


                foreach ($courses as $course) {
                    $day_time = json_decode($course->day_time, true);
                    $courseResult = [
                        'id' => $course->course_id,
                        'status' => $course->status,
                        'trainer_name' => $course->trainer_name,
                        'class_name' => $course->class_name,
                        'capacity' => $course->capacity,
                        'admin_name' => $course->admin_name,
                        'created_at' => $course->created_at,
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
                return view('Admin/Course/index', compact('results'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Courses Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Courses Table']);
        }
    }


    //عرض صفحة اضافة كورس

    public function create()
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Course');
            if ($check) {

                $classes = ClassT::all();
                $trainers = Trainer::all();
                $days = Day::all();
                return view('Admin/Course/create', compact('classes', 'trainers', 'days'));
            } else {
                throw UnauthorizedException::forPermissions(['Add Course']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Course']);
        }
    }
    //عرض الصفحة الثانية من اضافة كورس وهي اضافة الاوقات للايام

    public function create_2(Request $request)

    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Course');
            if ($check) {
                $class_id = $request->input('class');
                $trainer_id = $request->input('trainer');
                $day_ids = $request->input('day');
                $capacity = $request->input('capacity');
                $day_details = Day::whereIn('id', $day_ids)->get(['id', 'name'])->toArray();
                $times = Time::all();
                return view('Admin/Course/create2', compact('day_details', 'times', 'trainer_id', 'class_id','capacity'));
            } else {
                throw UnauthorizedException::forPermissions(['Add Course']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Course']);
        }
    }

    //تخزين الكورس في قاعدة البيانات

    public function store(Request $request)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Course');
            if ($check) {

                $trainer = Trainer::find($request->input('trainer_id'));
                $class_id = $request->input('class_id');
                $day_time = $request->input('day_time');
                $capacity = $request->input('capacity');
                $adminID = Auth::guard('admin')->user()->id;
                $day_times = json_encode($day_time);

            
               Course::create([
                'day_times' => $day_times,
                'capacity' => $capacity,
                'class_id' => $class_id,
                'trainer_id' => $trainer->id,
                'created_by'=> $adminID,
                'created_at' => now(),
               ]);
        

                return redirect()->route('admin.course.index')->with('message_success_store', 'Course Added Successfully');
            } else {
                throw UnauthorizedException::forPermissions(['Add Course']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Course']);
        }
    }

    //حذف الكورس ونقله الى الارشيف

    public function destroy(Course $course)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Move Course To Archive');
            if ($check) {
                $course->delete();
                return redirect()->back()->with('message_success_delete', 'Course Deleted Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Move Course To Archive']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Move Course To Archive']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_delete', 'Deleting error please try agin!');
        }
    }

    //عرض صفحة الارشيف 

    public function Archive()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Courses Arcvive Table');
            if ($check) {

                $deleted_courses = [];
                $courses = DB::select("
                SELECT courses.id AS course_id , courses.status AS status ,
                courses.capacity AS capacity , courses.created_by AS created_by,
                courses.created_at AS created_at,courses.deleted_at AS deleted_at,
                trainers.first_name AS trainer_name, class_t_s.name AS class_name ,
                courses.day_times AS day_time, admins.name AS admin_name
                FROM courses 
                INNER JOIN trainers ON courses.trainer_id = trainers.id 
                INNER JOIN class_t_s ON courses.class_id = class_t_s.id
                INNER JOIN admins ON courses.created_by = admins.id
            WHERE courses.deleted_at IS NOT NULL
        ");


                foreach ($courses as $course) {
                    $day_time = json_decode($course->day_time, true);
                    $courseResult = [
                        'id' => $course->course_id,
                        'status' => $course->status,
                        'trainer_name' => $course->trainer_name,
                        'class_name' => $course->class_name,
                         'capacity' => $course->capacity,
                        'admin_name' => $course->admin_name,
                        'created_at' => $course->created_at,
                        'deleted_at' => $course->deleted_at,
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

                return view('Admin/Course/Archive', compact('deleted_courses'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Courses Arcvive Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Courses Arcvive Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //استعادة الكورسات المحذوفة

    public function restore($id)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Restore Course');
            if ($check) {

                Course::withTrashed()->where('id', $id)->restore();
                return redirect()->back()->with('message_success_restore', 'Course Restored Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Restore Course']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Restore Course']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }

    //حذف الكورسات بشكل نهائي

    public function force_delete($id)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Course');
            if ($check) {

                Course::withTrashed()->where('id', $id)->forcedelete();
                return redirect()->back()->with('message_success_forcedelete', 'Course deleted Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Delete Course']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Delete Course']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }
}
