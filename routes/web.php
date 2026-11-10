<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title'=> 'Home', 'name'=>'John Doe']);
    // nama masih sementara
});
