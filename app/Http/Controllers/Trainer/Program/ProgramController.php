<?php

namespace App\Http\Controllers\Trainer\Program;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trainer\Trait\TrainerTrait;
use App\Models\ExerciseProgram;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProgramController extends Controller
{
    use TrainerTrait;

    //عرض البرامج الموجودة داخل الكورس 
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'courseID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $courseID = $request->input('courseID');
        $status = $request->input('status');

        if($status == 0)
        {
            $programs  = Program::where('course_id', $courseID)->where('status' , '0')->get();
        }elseif($status == 1)
        {
            $programs  = Program::where('course_id', $courseID)->where('status' , '1')->get();
        }
        else{
            $programs  = Program::where('course_id', $courseID)->get();
        }
        
        return $this->Data_Trainer($programs, 'Player Retrieved Successfully', 200);
    }


    //اضافة برنامج جديد

    public function addProgram(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'numberProgram' => 'required',
            'statusProgram' => 'required',
            'courseID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $name = $request->input('name');
        $numberProgram = $request->input('numberProgram');
        $status = $request->input('statusProgram');
        $courseID = $request->input('courseID');

       $program =  Program::create([
            'name' => $name,
            'number_program' => $numberProgram,
            'status' => $status,
            'course_id' => $courseID,
            'created_by' => Auth::guard('trainer')->user()->id,
        ]);

        $programID = $program->id;
        $programs = Program::where('id' , $programID)->get();

        return $this->Data_Trainer($programs, 'Program Stored Successfully', 200);
    }

    //تحديث بيانات برنامج
    
    public function updateProgram(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'programID' => 'required',
            'name' => 'required',
            'numberProgram' => 'required',
            'statusProgram' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $programID = $request->input('programID');
        $name = $request->input('name');
        $numberProgram = $request->input('numberProgram');
        $status = $request->input('statusProgram');

        $program = Program::findOrfail($programID);
        $program->update([
            'name' => $name,
            'number_program' => $numberProgram,
            'status' => $status,
        ]);

        $programs = Program::where('id' , $program->id)->get();
        return $this->Data_Trainer($programs, 'Program Updated Successfully', 200);
    }

    //حذف برنامج

    public function deleteProgram(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'programID' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $programID = $request->input('programID');

        $program = Program::findOrfail($programID);

        $program->forceDelete();

        return $this->Data_Trainer($program, 'Program Deleted Successfully', 200);

    }


     //عرض التمارين داخل البرنامج 

     public function GetExerciseProgram(Request $request)
     {

        $validator = Validator::make($request->all(), [
            'programID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $programID = $request->input('programID');

        $exercisePrograms = ExerciseProgram::where('programID' , $programID)->get();


        $additionalData = [];

        foreach($exercisePrograms as $exerciseProgram)
        {
            $id = $exerciseProgram->id;
            $numberOFSets =  $exerciseProgram->numberOFSets;
            $resetBetweenSets = $exerciseProgram->resetBetweenSets;
            $dublicatesInSets = $exerciseProgram->dublicatesInSets;
            $exerciseArrangement = $exerciseProgram->exerciseArrangement;
            $exerciseSystem = $exerciseProgram->exerciseSystem;
            $programName = $exerciseProgram->program->name;
            $exerciseID = $exerciseProgram->exercise->id;
            $exerciseName = $exerciseProgram->exercise->name;
            $exerciseDescription = $exerciseProgram->exercise->description;
            $exerciseVideo = $exerciseProgram->exercise->video;
            $created_at = $exerciseProgram->created_at;

            $additionalData[] = [
                'id' => $id,
                'numberOFSets' => $numberOFSets,
                'resetBetweenSets' => $resetBetweenSets,
                'dublicatesInSets' => $dublicatesInSets,
                'exerciseArrangement' => $exerciseArrangement,
                'exerciseSystem' => $exerciseSystem,
                'programName' => $programName,
                'exerciseID' => $exerciseID,
                'exerciseName' => $exerciseName,
                'exerciseDescription' => $exerciseDescription,
                'exerciseVideo' => $exerciseVideo,
                'created_at' => $created_at,
            ];

        }

        return $this->Data_Trainer($additionalData, 'Exercise Program Retrieved Successfully', 200);


     }



}

  
