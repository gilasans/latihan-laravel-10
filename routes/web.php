<?php

use App\Http\Controllers\DataTableController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BelajarController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/login',[LoginController::class,'index'])->name('login');

Route::get('/enkripsi',[BelajarController::class,'enkripsi'])->name('enkripsi');
Route::get('/enkripsi-detail/{params}',[BelajarController::class,'enkripsi_detail'])->name('enkripsi-detail');

Route::get('/forgot-password',[LoginController::class,'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-act',[LoginController::class,'forgot_password_act'])->name('forgot-password-act');

Route::get('/validasi-forgot-password/{token}',[LoginController::class,'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-act',[LoginController::class,'validasi_forgot_password_act'])->name('validasi-forgot-password-act');
Route::post('/login-proses',[LoginController::class,'login_proses'])->name('login-proses');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/register',[LoginController::class,'register'])->name('register');
Route::post('/register-proses',[LoginController::class,'register_proses'])->name('register-proses');



Route::get('/',[HomeController::class,'dashboard'])->name('dashboard'); //->middleware('can:view_dashboard'); //pemanfaatan  middleware dengan laravel gate
Route::get('/user',[HomeController::class,'index'])->name('index');
Route::get('/assets',[HomeController::class,'assets'])->name('assets');
Route::get('/create',[HomeController::class,'create'])->name('user.create');
Route::post('/store',[HomeController::class,'store'])->name('user.store');

Route::get('/clientSide',[DataTableController::class,'clientSide'])->name('clientSide');
Route::get('/serverSide',[DataTableController::class,'serverSide'])->name('serverSide');

Route::get('/edit/{id}',[HomeController::class,'edit'])->name('user.edit');
Route::get('/detail/{id}',[HomeController::class,'detail'])->name('user.detail');
Route::put('/update/{id}',[HomeController::class,'update'])->name('user.update');
Route::delete('/delete/{id}',[HomeController::class,'delete'])->name('user.delete');

// middleware cara lain
Route::group(['prefix' => 'admin','middleware' => ['auth'], 'as' =>'admin.'] , function(){

});


