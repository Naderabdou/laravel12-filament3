<?php

use Illuminate\Support\Facades\Route;


Route::get('/privacy', function () {

    session()->put('lang', 'en');

    return view('site.privacy');
});

Route::get('/privacy/ar', function () {

    session()->put('lang', 'ar');

    return view('site.privacy');
});
Route::get('/privacy/en', function () {

    session()->put('lang', 'en');

    return view('site.privacy');
});

Route::namespace('Site')->name('site.')->middleware('lang')->group(function () {});


Route::redirect('/login', '/admin/login')->name('login');
Route::redirect('/', '/admin/login');
