<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;

Route::get('/', [FrontController::class, 'index'])->name('front');
Route::get('/blogs/{id}', [FrontController::class, 'blogDetails'])->name('blogDetails');
Route::get('/events/{id}', [FrontController::class, 'eventDetails'])->name('eventDetails');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservation');
Route::get('/reservation/success', [ReservationController::class, 'success'])
    ->name('reservation.success')
    ->middleware('reservation.success');

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('/rooms', RoomController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::resource('/events', EventController::class);
    Route::resource('/blogs', BlogController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::get('/{page}', [FrontController::class, 'page'])->name('guest');
