<?php

namespace App\Http\Controllers\Trainer\Course;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trainer\Trait\TrainerTrait;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class ExerciseController extends Controller
{
    use TrainerTrait;

    //احضار التمارين الموجودة داخل الصفوف

    public function getExercise(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'courseID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $courseID = $request->only('courseID');

        $exercise = Exercise::where('course_id', $courseID)->get();

        return $this->Data_Trainer($exercise, 'Exercise Retrieved Successfully', 200);
    }


    //اضافة تمرين الى قائمة التمارين

    public function addExercise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $name = $request->input('name');
        $description = $request->input('description');
        $created_by = Auth::guard('trainer')->user()->id;
        $courseID = $request->input('courseID');


        $videoExercise = $request->file('video')->getClientOriginalName();
        $path = $request->file('video')->storeAs('ExerciseVideo', $videoExercise, 'exerciseVideo');

        $exercise = Exercise::create([
            'name' => $name,
            'description' => $description,
            'video' => $path,
            'course_id' => $courseID,
            'created_by' => $created_by
        ]);

        $exerciseID = $exercise->id;
        $exercises = Exercise::where('id', $exerciseID)->get();

        return $this->Data_Trainer($exercises, 'Exercise Stored Successfully', 200);
    }

    //تحديث معلومات تمرين بدون تحديث الفيديو الخاص به 

    public function updateWithoutVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'exerciseID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $name = $request->input('name');
        $description = $request->input('description');
        $exerciseID = $request->input('exerciseID');

        $exercise = Exercise::findOrfail($exerciseID);

        $exercise->update([
            'name' => $name,
            'description' => $description,
        ]);

        $exercises = Exercise::where('id', $exercise->id)->get();
        return $this->Data_Trainer($exercises, 'Exercise Updated Successfully', 200);
    }

    //تحديث معلومات تمرين مع تحديث الفيديو الخاص به

    public function updateWithVideo(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $exerciseID = $request->input('exerciseID');

        $exercise = Exercise::findOrfail($exerciseID);

        Storage::disk('exerciseVideo')->delete($exercise->video);

        $videoExercise = $request->file('video')->getClientOriginalName();
        $path = $request->file('video')->storeAs('ExerciseVideo', $videoExercise, 'exerciseVideo');

        $exercise->update([
            'name' => $name,
            'description' => $description,
            'video' => $path,
        ]);

        $exercises = Exercise::where('id', $exercise->id)->get();
        return $this->Data_Trainer($exercises, 'Exercise Updated Successfully', 200);
    }

    //حذف تمرين من قائمة التمارين


    public function deleteExercise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exerciseID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $exerciseID = $request->input('exerciseID');

        $exercise = Exercise::findOrfail($exerciseID);

        Storage::disk('exerciseVideo')->delete($exercise->video);

        $exercise->forceDelete();

        return $this->Data_Trainer($exercise, 'Exercise Delete Successfully', 200);
    }
}
