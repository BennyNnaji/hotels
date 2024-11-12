<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TestimonialController;

Route::get('/', [FrontController::class, 'index'])->name('front');
Route::get('/blogs/{id}', [FrontController::class, 'blogDetails'])->name('blogDetails');
Route::get('/features/{id}', [FrontController::class, 'featuresDetails'])->name('featuresDetails');
Route::get('/events/{id}', [FrontController::class, 'eventDetails'])->name('eventDetails');
Route::post('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/newsletter', [FrontController::class, 'newsletter'])->name('newsletter');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservation');
Route::get('/reservation/success', [ReservationController::class, 'success'])
    ->name('reservation.success')
    ->middleware('reservation.success');

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('/rooms', RoomController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::resource('/events', EventController::class);
    Route::resource('/blogs', BlogController::class);
    Route::resource('/features', FeatureController::class);
    Route::get('/newsletter', [MarketingController::class, 'index'])->name('newsletter');
    Route::resource('testimonials', TestimonialController::class);
    Route::get('/contact/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/update/{contact}', [ContactController::class, 'update'])->name('contact.update');
    Route::get('/terms/edit', [FrontController::class, 'terms'])->name('terms.edit');
    Route::put('/terms/update/{page}', [FrontController::class, 'termsUpdate'])->name('terms.update');
    Route::get('/privacy/edit', [FrontController::class, 'privacy'])->name('privacy.edit');
    Route::put('/privacy/update/{page}', [FrontController::class, 'privacyUpdate'])->name('privacy.update');
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::put('settings/highlights', [SettingController::class, 'updateHighlights'])->name('settings.updateHighlights');
    Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/update', [AboutController::class, 'update'])->name('about.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::get('/{page}', [FrontController::class, 'page'])->name('guest');
