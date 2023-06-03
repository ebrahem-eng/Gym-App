<?php

namespace App\Http\Controllers\Employe\Offer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    //عرض جدول العروضات والاسعار 

    public function index()
    {

        $results = [];
        $courses = DB::select("
SELECT courses.id AS course_id , courses.status AS status ,
trainers.first_name AS trainer_name, class_t_s.name AS class_name ,
courses.day_times AS day_time , offers.price_befor_discount AS price_befor_discount ,
offers.discount_value AS discount_value , offers.price_after_discount AS price_after_discount
FROM courses 
INNER JOIN trainers ON courses.trainer_id = trainers.id 
INNER JOIN class_t_s ON courses.class_id = class_t_s.id
INNER JOIN offers ON courses.id = offers.course_id
WHERE offers.deleted_at IS NULL
");


        foreach ($courses as $course) {
            $day_time = json_decode($course->day_time, true);
            $courseResult = [
                'id' => $course->course_id,
                'status' => $course->status,
                'trainer_name' => $course->trainer_name,
                'class_name' => $course->class_name,
                'price_befor_discount' => $course->price_befor_discount,
                'price_after_discount' => $course->price_after_discount,
                'discount_value' => $course->discount_value,
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
        return view('Employe/Offer/index', compact('results'));
    }



    public function create()
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
        return view('Employe/Offer/create', compact('results'));
    }

    //عرض الصفحة الثانية من اضافة عرض وهي اضافة السعر ونسبة الخصم

    public function create2($course_id)
    {

        return view('Employe/Offer/create2', compact('course_id'));
    }

    //تخزين العرض في قاعدة البيانات 

    public function store(Request $request)
    {
        $course_id = $request->input('course_id');

        // Check if the course already has an offer
        $existingOffer = Offer::where('course_id', $course_id)->first();
        if ($existingOffer) {
            return redirect()->route('employe.offer.create')->with('message_err', 'This course already has an offer.');
        }

        $price_before_discount = $request->input('price_befor_discount');
        $value_discount = $request->input('discount_value');
        $price_after_discount = $price_before_discount - ($value_discount / 100 * $price_before_discount);

        Offer::create([
            'course_id' => $course_id,
            'price_befor_discount' => $price_before_discount,
            'discount_value' => $value_discount,
            'price_after_discount' => $price_after_discount,
        ]);

        return redirect()->route('employe.offer.create')->with('message_success', 'Offer Added Successfully');
    }

    //حذف العرض ونقله الى الارشيف

    public function destroye(Offer $offer)
    {
        $offer->delete();
        return redirect()->back()->with('message_success', 'Offer Deleted Successfully');
    }

    //عرض ارشيف العروض

    public function archive()
    {


        $results = [];
        $courses = DB::select("
SELECT courses.id AS course_id , courses.status AS status ,
trainers.first_name AS trainer_name, class_t_s.name AS class_name ,
courses.day_times AS day_time , offers.price_befor_discount AS price_befor_discount ,
offers.discount_value AS discount_value , offers.price_after_discount AS price_after_discount
FROM courses 
INNER JOIN trainers ON courses.trainer_id = trainers.id 
INNER JOIN class_t_s ON courses.class_id = class_t_s.id
INNER JOIN offers ON courses.id = offers.course_id
WHERE offers.deleted_at IS NOT NULL
");


        foreach ($courses as $course) {
            $day_time = json_decode($course->day_time, true);
            $courseResult = [
                'id' => $course->course_id,
                'status' => $course->status,
                'trainer_name' => $course->trainer_name,
                'class_name' => $course->class_name,
                'price_befor_discount' => $course->price_befor_discount,
                'price_after_discount' => $course->price_after_discount,
                'discount_value' => $course->discount_value,
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
        return view('Employe/Offer/archive', compact('results'));
    }


    //استعادة عرض بعد الحذف

    public function restore($id)
    {
        Offer::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('message_success', 'Offer Restored Successfully!');
    }

    //حذف عرض بشكل نهائي

    public function force_delete($id)
    {

        Offer::withTrashed()->where('id', $id)->forcedelete();
        return redirect()->back()->with('message_success', 'Offer deleted Successfully!');
    }
}
