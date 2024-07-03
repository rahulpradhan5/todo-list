<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return redirect('home');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('register', [AuthController::class, 'register_view'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::post('addTask', [HomeController::class, 'addTask'])->name('addTask');
    Route::post('deleteTask', [HomeController::class, 'deleteTask'])->name('deleteTask');
    Route::post('markTask', [HomeController::class, 'markTask'])->name('markTask');
    Route::get('showAll', [HomeController::class, 'showAll'])->name('showAll');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
