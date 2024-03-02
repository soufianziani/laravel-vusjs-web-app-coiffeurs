<?php

use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Owner\ServiceController;
use App\Http\Controllers\Owner\StoreController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
    ]);
})->name('home');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('owner')->group(function(){
    Route::get('/create', [StoreController::class, 'index'])->name('create');
    Route::post('/stores', [StoreController::class, 'store'])->name('store');
    Route::get('/create/{id}/catigorie', [CategoryController::class , 'index'])->name('catigorie');
    Route::post('/store/catigorie/create', [CategoryController::class , 'store'])->name('store.categorie');
    Route::get('/store/{id}/services', [ServiceController::class, 'index'])->name('services');
    Route::post('/store/services/create', [ServiceController::class, 'store'])->name('store.service');
});



require __DIR__.'/auth.php';