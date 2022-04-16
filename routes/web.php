<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Admin;
use App\Http\Controllers\KeluhanController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('users.login');
});


Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web'])->group(function(){
        Route::get('login',[Login::class,'login'])->name('login');
        Route::get('register',[Login::class,'register'])->name('register');
        route::post('registers_proses',[Login::class,'proses_register'])->name('register_proses');
        Route::post('logins_proses',[Login::class,'proses_login'])->name('login_proses');

    });
    Route::middleware(['auth:web'])->group(function(){
        Route::post('/logout',[Login::class,'logout'])->name('logout');
        Route::get('dashboard',[Login::class,'dashboard'])->name('dashboards');
        Route::get('editKeluhan/{id}',[KeluhanController::class,'editKeluhan'])->name('EditKeluhan');
        Route::post('saveEditKeluhan/{id}',[KeluhanController::class,'saveEditKeluhan'])->name('saveEditKeluhan');
        Route::post('saveKeluhan',[KeluhanController::class,'saveKeluhan'])->name('saveKeluhan');
        Route::post('deleteKeluhan/{id}',[KeluhanController::class,'deleteKeluhan'])->name('deleteKeluhan');
        Route::get('addKeluhan',[KeluhanController::class,'addKeluhan'])->name('addKeluhan');
        Route::GET('viewKeluhan',[KeluhanController::class,'Keluhan'])->name('Keluhans');
    });

});

Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware(['guest:admin'])->group(function(){
            Route::get('login',[Admin::class,'login'])->name('login');
            route::post('logins_proses',[Admin::class,'proses_login'])->name('login_proses');
        });
        Route::middleware(['auth:admin'])->group(function(){
            Route::get('tanggapiKeluhan/{id}',[Admin::class,'tanggapiKeluhan'])->name('tanggapiKeluhan');
            Route::post('tanggapiKeluhans/{id}',[Admin::class,'tanggapiKeluhanSave'])->name('saveTanggapan');
            Route::get('editKeluhan/{id}',[Admin::class,'editKeluhan2'])->name('EditKeluhan');
            Route::post('saveEditKeluhan/{id}',[Admin::class,'saveEditKeluhan2'])->name('saveEditKeluhan2');
            Route::post('deleteKeluhan/{id}',[Admin::class,'deleteKeluhan2'])->name('deleteKeluhan');
            Route::get('viewKeluhans',[Admin::class,'KeluhanAdmin'])->name('Keluhanh');
            Route::post('/logout',[Admin::class,'logout'])->name('logout');
    });
});














Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
