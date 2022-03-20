<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/home',[HomeController::class,'redirect']);
Route::get('/',[HomeController::class,'index']);
Route::get('/add_doctor',[AdminController::class,'addview'])->name('add_doctor');
Route::post('/store',[AdminController::class,'upload'])->name('upload');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
