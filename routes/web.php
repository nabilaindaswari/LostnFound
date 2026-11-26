<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
$brand (nilainya = LostnFound) dibuat globnal dan di atur di app/Providers/AppServiceProvider.php:23:
View::share('brand', 'LostnFound');

View::share membuat $brand tersedia di semua view, 
termasuk komponen nav. Jadi {{$brand}} di nav.blade.php:8 aman dan tidak error.

*/

//////// AUTH

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware(['banned','guest']);
Route::post('/login', [AuthController::class, 'login'])->name('postLogin')->middleware('banned','guest');

// register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('postRegister')->middleware('guest');

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('postLogout')->middleware(['auth']);




Route::get('/', function () {
    return view('home', ['title'=> 'Home']);
    // nama masih sementara
})->name('home')->middleware(['auth', 'banned']);


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});