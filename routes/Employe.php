<?php

use App\Http\Controllers\Employe\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\Employe\EmployeController;
use App\Http\Controllers\Employe\Offer\OfferController;
use App\Http\Controllers\Employe\Player\PlayerController;
use App\Http\Controllers\Employe\RegisterPlayer\RegisterPlayerController;
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

Route::middleware(['employes'])->name('employe.')->prefix('employe')->group(function () {

//===================  check player route =============  

Route::get('/check/player/status' , [PlayerController::class , 'check_status_show'])->name('check.player.status');
Route::get('/player/course/details/{id}' , [PlayerController::class , 'player_course_details'])->name('player.course.details');
Route::get('/player/course/renewal/edit/{id}' , [PlayerController::class , 'player_course_renewal_edit'])->name('player.course.renewal.edit');
Route::post('/player/course/renewal/store/{id}' , [PlayerController::class , 'player_course_renewal_store'])->name('player.course.renewal.store');
Route::delete('/player/course/unregister/{id}' , [PlayerController::class , 'player_course_unregister'])->name('player.course.unregister');

//===================  offers route ======================

Route::get('/offer/show' , [OfferController::class , 'index'])->name('offer.index');
Route::get('/offer/create' , [OfferController::class , 'create'])->name('offer.create');
Route::post('/offer/create2/{course_id}',[OfferController::class , 'create2'])->name('offer.create2');
Route::post('/offer/store',[OfferController::class , 'store'])->name('offer.store');
Route::get('/offer/edit/{id}' , [OfferController::class , 'edit'])->name('offer.edit');
Route::put('/offer/update/{id}' , [OfferController::class , 'update'])->name('offer.update');
Route::delete('/offer/destroy/{offer}', [OfferController::class , 'destroye'])->name('offer.destroy');
Route::get('/offer/archive' , [OfferController::class , 'archive'])->name('offer.archive');
Route::get('/offer/restore/{id}' , [OfferController::class , 'restore'])->name('offer.restore');
Route::delete('/offer/force/delete/{id}', [OfferController::class , 'force_delete'])->name('offer.force.delete');

//====================== player register route ======================

Route::get('/register/new/player' , [RegisterPlayerController::class , 'registerNewPlayerCreate'])->name('register.new.player.create');
Route::post('/register/new/player/store' , [RegisterPlayerController::class , 'registerNewPlayerStore'])->name('register.new.player.store');
});



