<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');
Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
Route::get('/activities/edit/{id}', [ActivityController::class, 'edit'])->name('activities.edit');

Route::get('/', [HotelController::class, 'home'])->name('home');
Route::get('/about', function () { return view('hotel.aboutUs'); })->name('about');
Route::get('/contact', function () { return view('hotel.contact'); })->name('contact');
Route::get('/offers', [HotelController::class, 'offers'])->name('offers');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('hotel.roomDetails');
Route::post('/rooms/{room}/availability', [RoomController::class, 'checkAvailability'])->name('rooms.availability');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

require __DIR__.'/auth.php';
