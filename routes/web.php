<?php

use Illuminate\Support\Facades\Route;
use App\Models\Reservation;

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
    $reservations = Reservation::paginate(5);
    return view('home', compact('reservations'));
})->name('home');

Route::get('/new', 'App\Http\Controllers\ReservationController@create')->name('reservation.create');
Route::post('/new', 'App\Http\Controllers\ReservationController@store')->name('reservation.store');

Route::get('/edit/{id}', 'App\Http\Controllers\ReservationController@edit')->name('reservation.edit');
Route::patch('/edit/{id}', 'App\Http\Controllers\ReservationController@update')->name('reservation.update');
Route::delete('/delete/{id}', 'App\Http\Controllers\ReservationController@destroy')->name('reservation.delete');

