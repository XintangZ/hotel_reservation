<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Reservation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// home page
Route::get('/', function () {
    return view('home');
})->name('home');

// create reservation
Route::get('/new', 'App\Http\Controllers\ReservationController@create')->name('reservation.create');
Route::post('/new', 'App\Http\Controllers\ReservationController@store')->middleware(['auth', 'verified'])->name('reservation.store');

// edit & delete reservation
Route::middleware('auth')->group(function () {
    Route::get('/edit/{id}', 'App\Http\Controllers\ReservationController@edit')->name('reservation.edit');
    Route::patch('/edit/{id}', 'App\Http\Controllers\ReservationController@update')->name('reservation.update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\ReservationController@destroy')->name('reservation.delete');
});

// user home page
Route::get('/dashboard', function () {
    $reservations = Auth::user()->reservations()->paginate(5);
    return view('dashboard', compact('reservations'));
})->middleware(['auth', 'verified'])->name('dashboard');

// edit & delete user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
