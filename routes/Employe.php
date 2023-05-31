<?php

use App\Http\Controllers\Employe\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\Employe\EmployeController;
use App\Models\Employe;
use App\Models\Trainer;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Employe  Routes
|--------------------------------------------------------------------------

|
*/

Route::get('/employe', [EmployeController::class, 'index'])->middleware(['employes'])->name('employe.index');


//=================Employe Auth section ==============

Route::get('employe/login', [AuthAuthController::class, 'index'])->name('employe.show.login');
Route::post('employe/login/store', [AuthAuthController::class, 'store'])->name('employe.store.login');
Route::post('employe/logout', [AuthAuthController::class, 'logout'])->name('employe.logout');

//=================end employe auth section ========== 
