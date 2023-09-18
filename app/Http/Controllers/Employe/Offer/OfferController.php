<?php

namespace App\Http\Controllers\Employe\Offer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    //عرض جدول العروضات والاسعار 

    public function index()
    {

        try {

            $results = [];
            $courses = DB::select("
    SELECT courses.id AS course_id , courses.status AS status ,
    trainers.first_name AS trainer_name, class_t_s.name AS class_name ,
    courses.day_times AS day_time , offers.price_befor_discount AS price_befor_discount , 
    offers.discount_value AS discount_value ,
    offers.price_after_discount AS price_after_discount , employes.first_name AS employe_name
    FROM courses 
    INNER JOIN trainers ON courses.trainer_id = trainers.id 
    INNER JOIN class_t_s ON courses.class_id = class_t_s.id
    INNER JOIN offers ON courses.id = offers.course_id
    INNER JOIN employes ON offers.created_by = employes.id
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
                    'employe_name' => $course->employe_name,
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
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }


    //عرض الصفحة الاولى من اضافة العروض

    public function create()
    {

        try {

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
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض الصفحة الثانية من اضافة عرض وهي اضافة السعر ونسبة الخصم

    public function create2($course_id)
    {
        try {
            return view('Employe/Offer/create2', compact('course_id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين العرض في قاعدة البيانات 

    public function store(Request $request)
    {
        $course_id = $request->input('course_id');
        $employeID = Auth::guard('employe')->user()->id;

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
            'created_by' => $employeID,
        ]);

        return redirect()->route('employe.offer.create')->with('message_success', 'Offer Added Successfully');
    }

    //عرض صفحة تعديل عرض

    public function edit($id)
    {
        $offer = Offer::findOrfail($id);
        return view('Employe.Offer.edit', compact('offer'));
    }

    //تخزين التحديثات في قاعدة البيانات 

    public function update(Request $request, $id)
    {
        $offer = Offer::findOrfail($id);
        $price_before_discount = $request->input('price_befor_discount');
        $value_discount = $request->input('discount_value');
        $price_after_discount = $price_before_discount - ($value_discount / 100 * $price_before_discount);

        $offer->update([
            'price_befor_discount' => $price_before_discount,
            'discount_value' => $value_discount,
            'price_after_discount' => $price_after_discount,
        ]);

        return redirect()->back()->with('message_success', 'Offer Updated Successfully');
    }

    //حذف العرض ونقله الى الارشيف

    public function destroye(Offer $offer)
    {
        try {
            $offer->delete();
            return redirect()->back()->with('message_success', 'Offer Deleted Successfully');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض ارشيف العروض

    public function archive()
    {
        try {

            $results = [];
            $courses = DB::select("
SELECT courses.id AS course_id , courses.status AS status ,
trainers.first_name AS trainer_name, class_t_s.name AS class_name ,
courses.day_times AS day_time , offers.price_befor_discount AS price_befor_discount ,
offers.deleted_at AS deleted_at,
offers.discount_value AS discount_value , offers.price_after_discount AS price_after_discount,
employes.first_name AS employe_name
FROM courses 
INNER JOIN trainers ON courses.trainer_id = trainers.id 
INNER JOIN class_t_s ON courses.class_id = class_t_s.id
INNER JOIN offers ON courses.id = offers.course_id
INNER JOIN employes ON offers.created_by = employes.id
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
                    'employe_name' => $course->employe_name,
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

                $results[] = $courseResult;
            }
            return view('Employe/Offer/archive', compact('results'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //استعادة عرض بعد الحذف

    public function restore($id)
    {
        try {

            Offer::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success', 'Offer Restored Successfully!');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //حذف عرض بشكل نهائي

    public function force_delete($id)
    {

        try {

            Offer::withTrashed()->where('id', $id)->forcedelete();
            return redirect()->back()->with('message_success', 'Offer deleted Successfully!');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
