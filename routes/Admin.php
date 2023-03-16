<?php

use App\Http\Controllers\Admin\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
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

//     return view('admin.index');
// })->middleware(['auth', 'verified' , 'role:Admin'])->name('dashboard');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['admin'])->name('admin.index');

Route::middleware(['admin'])->name('admin.')->prefix('admin')->group(function () {
    //============ Admin Employe ==========

    Route::get('/employe/archive', [EmployeController::class, 'Archive'])->name('employe.archive');
    Route::get('/employe/restore/{id}', [EmployeController::class, 'restore'])->name('employe.restore');
    Route::get('/employe/forcedelete/{id}', [EmployeController::class, 'force_delete'])->name('employe.forcedelete');

    Route::get('/employe/resetpassword/show', [EmployeController::class, 'reset_password_show'])->name('employe.reset.password.show');
    Route::get('employe/resetpassword/edit/{employe}', [EmployeController::class, 'reset_password_edit'])->name('employe.reset.password.edit');
    Route::put('employe/resetpassword/update/{employe}', [EmployeController::class, 'reset_password_update'])->name('employe.reset.password.update');

    Route::get('/employ/{employe}', [EmployeController::class, 'show'])->name('employe.show.roles');
    Route::post('/employe/{employe}/roles', [EmployeController::class, 'assignrole'])->name('employe.roles');
    Route::delete('/employe/{employe}/roles/{role}', [EmployeController::class, 'removerole'])->name('employe.roles.remove');

    Route::post('/employe/{employe}/permissions', [EmployeController::class, 'givepermission'])->name('employe.permissions');
    Route::delete('/employe/{employe}/permissions/{permission}', [EmployeController::class, 'revokepermission'])->name('employe.permissions.revoke');

    Route::resource('/employe', EmployeController::class);

    //============= Admin Trainer =========

    Route::get('/trainer/restore/{id}', [TrainerController::class, 'restore'])->name('trainer.restore');
    Route::get('/trainer/forcedelete/{id}', [TrainerController::class, 'force_delete'])->name('trainer.forcedelete');

    Route::get('/trainer/resetpassword/show', [TrainerController::class, 'reset_password_show'])->name('trainer.reset.password.show');
    Route::get('trainer/resetpassword/edit/{trainer}', [TrainerController::class, 'reset_password_edit'])->name('trainer.reset.password.edit');
    Route::put('trainer/resetpassword/update/{trainer}', [TrainerController::class, 'reset_password_update'])->name('trainer.reset.password.update');

    Route::get('/trainer/archive', [TrainerController::class, 'Archive'])->name('trainer.archive');
    Route::resource('/trainer', TrainerController::class);

    //============= Admin Class ===========

    Route::get('/class/archive', [ClassController::class, 'Archive'])->name('class.archive');
    Route::get('/class/restore/{id}', [ClassController::class, 'restore'])->name('class.restore');
    Route::get('/class/forcedelete/{id}', [ClassController::class, 'force_delete'])->name('class.forcedelete');
    Route::resource('/class', ClassController::class);


    //============= Admin Admin ===========
    Route::get('/admin/archive', [AdminAdminController::class, 'Archive'])->name('admin.archive');
    Route::get('/admin/restore/{id}', [AdminAdminController::class, 'restore'])->name('admin.restore');
    Route::get('/admin/forcedelete/{id}', [AdminAdminController::class, 'force_delete'])->name('admin.forcedelete');
    Route::get('/admin/resetpassword/show', [AdminAdminController::class, 'reset_password_show'])->name('admin.reset.password.show');
    Route::get('admin/resetpassword/edit/{admin}', [AdminAdminController::class, 'reset_password_edit'])->name('admin.reset.password.edit');
    Route::put('admin/resetpassword/update/{admin}', [AdminAdminController::class, 'reset_password_update'])->name('admin.reset.password.update');
    Route::get('/admin/role/{admin}', [AdminAdminController::class, 'show'])->name('admin.show.roles');
    Route::post('/admin/{admin}/roles', [AdminAdminController::class, 'assignrole'])->name('admin.roles');
    Route::delete('/admin/{admin}/roles/{role}', [AdminAdminController::class, 'removerole'])->name('admin.roles.remove');
    Route::resource('/admin', AdminAdminController::class);

    //============= Admin Role ============

    Route::get('/roles/givepermission/{role}', [RoleController::class, 'go_to_give_permissions'])->name('go.roles.permissions');
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givepermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokepermission'])->name('roles.permissions.revoke');

    Route::resource('/roles', RoleController::class);


    //============ Admin Permission ===========

    Route::get('/permissions/giveroles/{permission}', [PermissionController::class, 'go_to_give_permissions'])->name('go.permissions.roles');
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'giverole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removepermission'])->name('permissions.roles.remove');
    Route::resource('/permissions', PermissionController::class);

    //============ Admin Report ============


});

Route::name('admin.')->prefix('admin')->group(function () {
    Route::resource('/report', ReportController::class);
});


//=================Admin Atuh section ==============

Route::get('admin/login', [AuthController::class, 'index'])->name('admin.show.login');
Route::post('admin/login/store', [AuthController::class, 'store'])->name('admin.store.login');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

//=================end admin auth section ========== 


//<========end Admin section =========>
