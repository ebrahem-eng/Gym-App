<?php

namespace App\Http\Controllers\Trainer\Course;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trainer\Trait\TrainerTrait;
use App\Models\Player;
use App\Models\Player_Course;
use App\Models\Program_Player;
use Illuminate\Http\Request;
use Validator;

class PlayerController extends Controller
{
    use TrainerTrait;

    //احضار اللاعبين المسجلين في الكورس 

    public function getPlayer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'courseID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $courseID = $request->only('courseID');
        $playerDetails = Player_Course::with('player')
        ->where('course_id', $courseID)->get();
        
        $additionalData = [];

        foreach($playerDetails as $playerDetail)
        {
            $id = $playerDetail->player->id;
            $first_name =  $playerDetail->player->first_name;
            $last_name = $playerDetail->player->last_name;
            $email = $playerDetail->player->email;
            $img = $playerDetail->player->img;
            $address = $playerDetail->player->address;
            $age = $playerDetail->player->age;
            $phone = $playerDetail->player->phone;
            $level = $playerDetail->player->level;
            $status = $playerDetail->player->status;
            $gender = $playerDetail->player->gender;
            $created_at = $playerDetail->player->created_at;
            $playerCourseID = $playerDetail->course_id;

            $additionalData[] = [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'img' => $img,
                'address' => $address,
                'age' => $age,
                'phone' => $phone,
                'level' => $level,
                'status' => $status,
                'gender' => $gender,
                'created_at' => $created_at,
                'playerCourseID' => $playerCourseID,

            ];

        }

        return $this->Data_Trainer($additionalData, 'Player Retrieved Successfully', 200);
    }

     //البحث عن اللاعبين المسجلين في الكورس 

    public function getPlayerSearch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'playerName' => 'required',
            'courseID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $playerName = $request->only('playerName');
        $courseID = $request->only('courseID');
        $playerDetails = Player_Course::with('player')
        ->where('course_id', $courseID)
        ->whereHas('player', function ($query) use ($playerName) {
            $query->where('first_name','LIKE',$playerName);
        })
        ->get();
        
        $additionalData = [];

        foreach($playerDetails as $playerDetail)
        {
            $id = $playerDetail->player->id;
            $first_name =  $playerDetail->player->first_name;
            $last_name = $playerDetail->player->last_name;
            $email = $playerDetail->player->email;
            $img = $playerDetail->player->img;
            $address = $playerDetail->player->address;
            $age = $playerDetail->player->age;
            $phone = $playerDetail->player->phone;
            $level = $playerDetail->player->level;
            $status = $playerDetail->player->status;
            $gender = $playerDetail->player->gender;
            $created_at = $playerDetail->player->created_at;
            $playerCourseID = $playerDetail->course_id;

            $additionalData[] = [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'img' => $img,
                'address' => $address,
                'age' => $age,
                'phone' => $phone,
                'level' => $level,
                'status' => $status,
                'gender' => $gender,
                'created_at' => $created_at,
                'playerCourseID' => $playerCourseID,

            ];

        }

        return $this->Data_Trainer($additionalData, 'Player Retrieved Successfully', 200);

    }

    public function get_program_course_player(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'playerID' => 'required',
            'courseID' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $playerID = $request->input('playerID');
        $courseID = $request->input('courseID');
        $programs = Program_Player::with('program', 'player')->where('player_id', $playerID)
            ->whereHas('program', function ($query) use ($courseID) {
                $query->where('course_id', $courseID);
            })
            ->get();

        $additionalData = [];


        foreach ($programs as $program) {
            $id = $program->id;
            $programStartDate = $program->start_date;
            $programEndDate = $program->end_date;

            $programID = $program->program->id;
            $programName = $program->program->name;
            $numberProgram = $program->program->number_program;
            $programStatus = $program->program->status;
            $programCourseID = $program->program->course_id;

            $playerID = $program->player->id;
            $playerFirstName = $program->player->first_name;
            $playerLastName = $program->player->last_name;
            $playerEmail = $program->player->email;
            $playerImg = $program->player->img;
            $playerAddress = $program->player->address;
            $playerAge = $program->player->age;
            $playerPhone = $program->player->phone;
            $playerLevel = $program->player->level;
            $playerStatus = $program->player->status;
            $playerGender = $program->player->gender;



            $additionalData[] = [
                'id' => $id,
                'programStartDate' => $programStartDate,
                'programEndDate' => $programEndDate,
                'programID' => $programID,
                'programName' => $programName,
                'numberProgram' => $numberProgram,
                'programCourseID' => $programCourseID,
                'programStatus' => $programStatus,
                'playerID' => $playerID,
                'playerFirstName' => $playerFirstName,
                'playerLastName' => $playerLastName,
                'playerEmail' => $playerEmail,
                'playerImg' => $playerImg,
                'playerAddress' => $playerAddress,
                'playerAge' => $playerAge,
                'playerPhone' => $playerPhone,
                'playerLevel' => $playerLevel,
                'playerStatus' => $playerStatus,
                'playerGender' => $playerGender,
            ];
        }

        return $this->Data_Trainer($additionalData, 'Player Program Retrieved Successfully', 200);
    }
}
