<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MainController;
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
Route::get('/', [MainController::class, 'index'])->middleware('weather')->name('home');
// search result page
Route::get('/search', [MainController::class, 'search'])->middleware('weather')->name('room.search');

// create & edit & delete reservation
Route::middleware('auth')->group(function () {
    Route::post('/new', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/edit/{id}', [ReservationController::class, 'edit'])->middleware('weather')->name('reservation.edit');
    Route::post('/edit/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('/delete/{id}', [ReservationController::class, 'destroy'])->name('reservation.delete');
});

// user home page
Route::get('/dashboard', function () {
    $reservations = Auth::user()->reservations()->orderBy('created_at', 'desc')->paginate(5);
    return view('dashboard', compact('reservations'));
})->middleware(['auth', 'verified'])->name('dashboard');

// edit & delete user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware('weather')->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
