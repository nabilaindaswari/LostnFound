<?php

use Illuminate\Support\Facades\Route;

/*
$brand (nilainya = LostnFound) dibuat globnal dan di atur di app/Providers/AppServiceProvider.php:23:
View::share('brand', 'LostnFound');

View::share membuat $brand tersedia di semua view, 
termasuk komponen nav. Jadi {{$brand}} di nav.blade.php:8 aman dan tidak error.

*/

Route::get('/', function () {
    return view('home', ['title'=> 'Home', 'name'=>'John Doe']);
    // nama masih sementara
});