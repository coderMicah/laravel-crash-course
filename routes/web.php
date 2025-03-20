<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;


Route::view('/', 'welcome');
Route::view('/contact', 'contact');

Route::resource('jobs', JobController::class);

//Auth
Route::get('/register',[RegisterUserController::class,'create'] );
Route::post('/register',[RegisterUserController::class,'store'] );

//Loggin
Route::get('/login',[SessionController::class,'create']);
Route::post('/login',[SessionController::class,'store'] );

