<?php

use App\Http\Controllers\FoundItemController;
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


// //// DISPLAY

// temuan
Route::get('/temuan', [FoundItemController::class, 'showCatalog'])->name('temuan.index');
Route::get('/temuan/create', [FoundItemController::class, 'showCreate'])->name('temuan.create')->middleware(['auth', 'banned']);
Route::get('/temuan/{id}', [FoundItemController::class, 'showid'])->name('temuan.show')->middleware(['auth', 'banned']);
Route::post('/temuan', [FoundItemController::class, 'createTemuan'])->name('temuan.post')->middleware(['auth', 'banned']);


Route::get('/', function () {
    return view('home', ['title'=> 'Home']);
    // masih sementara
})->name('home');


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});