<?php

use App\Http\Controllers\Admin\Class\ClassController;
use App\Http\Controllers\Admin\Employe\EmployeController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Trainer\TrainerController;
use App\Models\Employe;
use App\Models\Trainer;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------

|
*/

//<=====Admin Section======>

// Route::get('/dashboard', function () {
//  
//     return view('admin.index')
// })->middleware(['auth', 'verified' , 'role:Admin'])->name('dashboard');

Route::get('/admin', function () {
    $trainer_count = Trainer::all()->count();
    $employe_count = Employe::all()->count();
    return view('admin.index',compact('trainer_count','employe_count'));
})->middleware(['auth', 'verified','role:Admin'])->name('admin.index');

Route::middleware(['auth', 'verified','role:Admin'])->name('admin.')->prefix('admin')->group(function(){
    //============ Admin Employe ==========

Route::get('/employe/archive',[EmployeController::class , 'Archive'])->name('employe.archive');
Route::get('/employe/restore/{id}',[EmployeController::class , 'restore'])->name('employe.restore');
Route::get('/employe/forcedelete/{id}',[EmployeController::class , 'force_delete'])->name('employe.forcedelete');

//Route::get('/employ/{employe}',[EmployeController::class , 'show'])->name('employe.show.roles');
Route::post('/employe/{employe}/roles',[EmployeController::class ,'assignrole'])->name('employe.roles');
Route::delete('/employe/{employe}/roles/{role}',[EmployeController::class , 'removerole'])->name('employe.roles.remove');

Route::post('/employe/{employe}/permissions',[EmployeController::class ,'givepermission'])->name('employe.permissions');
Route::delete('/employe/{employe}/permissions/{permission}',[EmployeController::class , 'revokepermission'])->name('employe.permissions.revoke');

Route::resource('/employe',EmployeController::class);

//============= Admin Trainer =========

Route::get('/trainer/restore/{id}',[TrainerController::class , 'restore'])->name('trainer.restore');
Route::get('/trainer/forcedelete/{id}',[TrainerController::class , 'force_delete'])->name('trainer.forcedelete');

Route::get('/trainer/archive',[TrainerController::class , 'Archive'])->name('trainer.archive');
Route::resource('/trainer',TrainerController::class);

//============= Admin Class ===========

Route::get('/class/archive',[ClassController::class , 'Archive'])->name('class.archive');
Route::get('/class/restore/{id}',[ClassController::class , 'restore'])->name('class.restore');
Route::get('/class/forcedelete/{id}',[ClassController::class , 'force_delete'])->name('class.forcedelete');
Route::resource('/class',ClassController::class);

//============= Admin Role ============

Route::get('/roles/givepermission/{role}',[RoleController::class , 'go_to_give_permissions'])->name('go.roles.permissions');
Route::post('/roles/{role}/permissions',[RoleController::class ,'givepermission'])->name('roles.permissions');
Route::delete('/roles/{role}/permissions/{permission}',[RoleController::class , 'revokepermission'])->name('roles.permissions.revoke');

Route::resource('/roles',RoleController::class);


//============ Admin Permission ===========

Route::get('/permissions/giveroles/{permission}',[PermissionController::class , 'go_to_give_permissions'])->name('go.permissions.roles');
Route::post('/permissions/{permission}/roles',[PermissionController::class ,'giverole'])->name('permissions.roles');
Route::delete('/permissions/{permission}/roles/{role}',[PermissionController::class , 'removepermission'])->name('permissions.roles.remove');
Route::resource('/permissions',PermissionController::class);

//============ Admin Report ============

Route::resource('/report',ReportController::class);
});




//<========end Admin section =========>

