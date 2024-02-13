<?php

use App\Http\Controllers\Trainer\Auth\AuthController;
use App\Http\Controllers\Trainer\Course\CourseController;
use App\Http\Controllers\Trainer\Course\ExerciseController;
use App\Http\Controllers\Trainer\Course\PlayerController;
use App\Http\Controllers\Trainer\PersonalInfo\PersonalInfoController;
use App\Http\Controllers\Trainer\Program\ProgramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//تسجيل الدخول والبروفايل والتسجيل 

Route::group([
    'middleware' => 'trainer',
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});


Route::middleware(['trainer', 'auth:trainer'])->group(function () {

    //عرض بيانات المدرب
    Route::get('/personal/info', [PersonalInfoController::class, 'index']);

    //عرض الكورسات الخاصة بالمدرب 
    Route::get('/courses', [CourseController::class, 'index']);


    //عرض بيانات اللاعبين المسجلين في الكورسات

    Route::get('/courses/player', [PlayerController::class, 'getPlayer']);

    //البحث بيانات اللاعبين المسجلين في الكورسات

    Route::get('/courses/player/search', [PlayerController::class, 'getPlayerSearch']);

    //عرض البرامج الخاصة باللاعب داخل الكورس المسجل فيه

    Route::get('/courses/player/program', [PlayerController::class, 'get_program_course_player']);

    //عرض البرامج الموجودة داخل الكورس 
    Route::get('/courses/program', [ProgramController::class, 'index']);

    //عرض التمارين الموجودة داخل الكورس 
    Route::get('/courses/exercise', [ExerciseController::class, 'getExercise']);

    //اضافة تمرين جديد للكورس
    Route::post('/courses/exercise/store', [ExerciseController::class, 'addExercise']);

    //تعديل تمرين بدون فيديو للكورس
    Route::put('/courses/exercise/update/withoutVideo', [ExerciseController::class, 'updateWithoutVideo']);


    //تعديل تمرين مع فيديو للكورس
    Route::post('/courses/exercise/update/withVideo', [ExerciseController::class, 'updateWithVideo']);

    //حذف تمرين للكورس
    Route::delete('/courses/exercise/delete', [ExerciseController::class, 'deleteExercise']);

    //اضافة برنامج جديد

    Route::post('/courses/program/store', [ProgramController::class, 'addProgram']);

    //تعديل برنامج 

    Route::put('/courses/program/update', [ProgramController::class, 'updateProgram']);
    
    //حذف برنامج 

    Route::delete('/courses/program/delete', [ProgramController::class, 'deleteProgram']);


    //عرض التمارين داخل البرامج

    Route::get('/courses/program/exercise', [ProgramController::class, 'GetExerciseProgram']);
});
