<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Owner\ServiceController;
use App\Http\Controllers\Owner\StoreController;
use App\Http\Controllers\Owner\WorkTimeController;
use App\Http\Controllers\StoreListController;
use App\Http\Controllers\TypeController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('owner')->group(function () {
    Route::get('/create/worktime/{id}', [WorkTimeController::class, 'index'])->name('worktime');
    Route::post('/store/worktime', [WorktimeController::class, 'store'])->name('worktime.store');
    Route::get('/type', [TypeController::class, 'index'])->name('type');
    Route::post('/stores', [StoreController::class, 'store'])->name('store');
    Route::get('/create/{id}', [StoreController::class, 'index'])->name('create');
    Route::get('/create/{id}/catigorie', [CategoryController::class, 'index'])->name('catigorie');
    Route::post('/delete/{id}/catigorie', [CategoryController::class, 'destroy'])->name('catigorie.delete');
    Route::post('/store/catigorie/create', [CategoryController::class, 'store'])->name('store.categorie');
    Route::get('/store/{id}/services', [ServiceController::class, 'index'])->name('services');
    Route::post('/store/services/create', [ServiceController::class, 'store'])->name('store.service');
});




require __DIR__ . '/auth.php';
