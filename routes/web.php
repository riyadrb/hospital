<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('index');

Route::get('/home',[HomeController::class,'redirect'])->middleware('auth','verified')->name('redirect');
Route::get('/add_doctor',[AdminController::class,'addview'])->name('add_doctor');
Route::post('/upload',[AdminController::class,'upload'])->name('upload');

Route::post('/appointment',[HomeController::class,'appointment'])->name('appointment');
Route::get('/my_appointment',[HomeController::class,'my_appointment'])->name('my_appointment');
Route::get('/cancel/{id}',[HomeController::class,'cancel'])->name('cancel');

Route::get('/showappoint',[AdminController::class,'show_appointment'])->name('showappoint');
Route::get('/approved/{id}',[AdminController::class,'approve'])->name('approved');
Route::get('/canceled/{id}',[AdminController::class,'canceled'])->name('canceled');
Route::get('/show_doctor',[AdminController::class,'show_doctor'])->name('show_doctor');
Route::get('/del_doctor/{id}',[AdminController::class,'del_doctor'])->name('del_doctor');
Route::get('/edit/{id}',[AdminController::class,'edit'])->name('edit');
Route::post('/update/{id}',[AdminController::class,'update'])->name('update');
Route::get('/email/{id}',[AdminController::class,'email'])->name('email');
Route::post('/sendmail/{id}',[AdminController::class,'sendmail'])->name('sendmail');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
