<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/home',[HomeController::class,'redirect'])->name('redirect');
Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/add_doctor',[AdminController::class,'addview'])->name('add_doctor');
Route::post('/upload',[AdminController::class,'upload'])->name('upload');

Route::post('/appointment',[HomeController::class,'appointment'])->name('appointment');
Route::get('/my_appointment',[HomeController::class,'my_appointment'])->name('my_appointment');
Route::get('/cancel/{id}',[HomeController::class,'cancel'])->name('cancel');
Route::get('/showappoint',[AdminController::class,'show_appointment'])->name('showappoint');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
