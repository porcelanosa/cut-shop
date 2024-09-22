<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

//        logger()->channel('telegram')->debug('$message');

    return view('welcome');
})->name('home');


Route::get('/login', function () {
    return view('auth.index');
})->name('login');

Route::get('/about', function () {
    return view('page.about');
})->name('about');
