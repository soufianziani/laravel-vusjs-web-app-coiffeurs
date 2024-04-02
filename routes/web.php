<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Owner\ServiceController;
use App\Http\Controllers\Owner\StoreController;     
use App\Http\Controllers\Owner\WorkTimeController;
use App\Http\Controllers\Owner\ReservationController;
use App\Http\Controllers\StoreListController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::controller(StoreListController::class)->group(function (){
    Route::get('/store/list/{type}/{city}' , 'index')->name('listStore');
    Route::get('/store/show/{type}/{city}/{id}' , 'show')->name('showList.show'); 
});

Route::controller(AppointmentController::class)->group(function(){
    Route::post('/store/reserve/services', 'store')->name('reserve.store');
    Route::get('/store/reserve/{store_id}/serivce/{service_id}', 'index')->name('reserve');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('user/dashboard' , [UserDashboardController::class , 'index'])->name('user.dashboard'); 
    Route::get('user/dashboard/download' , [UserDashboardController::class , 'download'])->name('user.download'); 
    Route::get('user/dashboard/reservation/show/{id}' , [UserDashboardController::class , 'show'])->name('user.show'); 
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('owner')->group(function () {
    // -------------------------------------------------------------------------------------------------------------------------
    Route::get('/owner/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/owner/dashboard/store', [StoreController::class, 'edit'])->name('store.edit');
    Route::get('/owner/dashboard/categories', [CategoryController::class , 'index'])->name('store.categories');
    Route::post('/owner/dashboard/categories/store', [CategoryController::class , 'store'])->name('categories.store');
    Route::get('/owner/dashboard/worktime', [WorkTimeController::class, 'index'])->name('store.worktime');
    Route::post('/owner/dashboard/worktime/store', [WorktimeController::class, 'store'])->name('worktime.store');
    Route::get('/owner/dashboard/services', [ServiceController::class, 'index'])->name('store.services');
    Route::get('/owner/dashboard/store/reservation/' , [ReservationController::class , 'index'])->name('store.reservation');
    Route::get('/owner/dashboard/store/reservation/show/{id}' , [ReservationController::class , 'show'])->name('reservation.show');
    Route::post('/owner/dashboard/reservations/{id}/update-status', [ReservationController::class, 'updateStatus'])->name('reservation.updateStatus');
    Route::post('/owner/dashboard/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::post('/owner/dashboard/update/store/{id}', [StoreController::class, 'update'])->name('store.update');
    Route::get('/owner/dashboard/services/{id}', [StoreController::class, 'edit'])->name('service.edit');
    Route::post('/owner/dashboard/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::post('/owner/dashboard/services/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
    Route::get('/owner/dashboard/{id}' ,[DashboardController::class , 'index'])->name('owner.dashboard');
    // -------------------------------------------------------------------------------------------------------------------------
    Route::get('/type', [TypeController::class, 'index'])->name('type');
    Route::post('/stores', [StoreController::class, 'store'])->name('store');
    Route::get('/create/store/{id}', [StoreController::class, 'index'])->name('create');
});

require __DIR__ . '/auth.php';