<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Trainer\Auth\AuthController as AuthAuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => 'jwt.trainer' ,  'prefix' => 'trainer'], function () {
   
//     Route::post('/login', [AuthAuthController::class, 'login']);
// });

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('/login', [AuthAuthController::class, 'login']);
//     Route::post('/register', [AuthAuthController::class, 'register']);
//     Route::post('/logout', [AuthAuthController::class, 'logout']);
//     Route::post('/refresh', [AuthAuthController::class, 'refresh']);
//     Route::get('/user-profile', [AuthAuthController::class, 'userProfile']);    
// });

