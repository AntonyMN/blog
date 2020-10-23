<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('blogs', App\Http\Controllers\BlogController::class);
});

Route::group(['prefix' => 'admin'], function() {
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('blog-categories', App\Http\Controllers\BlogCategoryController::class);
});
