<?php

use App\Http\Controllers\Admin\Class\ClassController;
use App\Http\Controllers\Admin\Employe\EmployeController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Trainer\TrainerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//<=====Admin Section======>

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified' , 'role:Admin'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'verified','role:Admin'])->name('admin.index');

Route::middleware(['auth', 'verified','role:Admin'])->name('admin.')->prefix('admin')->group(function(){
Route::get('/employe/archive',[EmployeController::class , 'Archive'])->name('employe.archive');
Route::resource('/employe',EmployeController::class);
Route::get('/trainer/archive',[TrainerController::class , 'Archive'])->name('trainer.archive');
Route::resource('/trainer',TrainerController::class);
Route::get('/class/archive',[ClassController::class , 'Archive'])->name('class.archive');
Route::resource('/class',ClassController::class);
Route::resource('/roles',RoleController::class);
Route::resource('/permissions',PermissionController::class);
Route::resource('/report',ReportController::class);

});


//<========end Admin section =========>

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
