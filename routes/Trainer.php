<?php

use App\Http\Controllers\Trainer\Auth\AuthController;
use App\Http\Controllers\Trainer\Course\CourseController;
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


Route::middleware(['trainer','auth:trainer'])->group(function () {

    //عرض الكورسات الخاصة بالمدرب 
    Route::get('/courses' , [CourseController::class , 'index']);
});


