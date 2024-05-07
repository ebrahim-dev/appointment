<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index']);
Route::get('/home', [HomeController::class,'redirect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
       return redirect('/home');
    })->name('dashboard');
});
Route::get('/add_doctor_view', [AdminController::class,'addview']);
Route::post('/upload_doctor', [AdminController::class,'upload']);
Route::post('/appointment', [HomeController::class,'appointment']);
Route::get('/myappointment', [HomeController::class,'myappointment']);
Route::get('/cancel_appoint/{id}', [HomeController::class,'cancel_appoint']);
Route::get('/appointments', [AdminController::class,'appointments']);
Route::get('/edit_appointments/{id}', [AdminController::class,'edit_appointments']);
Route::get('/approved/{id}', [AdminController::class,'approved']);
Route::get('/rewait/{id}', [AdminController::class,'rewait']);
Route::get('/show_doctors', [AdminController::class,'show_doctors']);
Route::get('/delete_doctor/{id}', [AdminController::class,'delete_doctor']);
Route::get('/edit_doctor/{id}', [AdminController::class,'edit_doctor']);
Route::post('/update_doctor', [AdminController::class,'update_doctor']);
Route::get('/sendemail', [EmailController::class,'sendWelcomeEmail'])->name('sendemail');