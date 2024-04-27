<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Models\Reservation;
use App\Models\RoomType;

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

Route::get('/search', [ReservationController::class, 'show'])->name('reservation.search');

// create reservation
Route::get('/new', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/new', [ReservationController::class, 'store'])->middleware(['auth', 'verified'])->name('reservation.store');

// edit & delete reservation
Route::middleware('auth')->group(function () {
    Route::get('/edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::patch('/edit/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('/delete/{id}', [ReservationController::class, 'destroy'])->name('reservation.delete');
});

// user home page
Route::get('/dashboard', function () {
    $reservations = Auth::user()->reservations()->orderBy('created_at', 'desc')->paginate(5);
    return view('dashboard', compact('reservations'));
})->middleware(['auth', 'verified'])->name('dashboard');

// edit & delete user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
