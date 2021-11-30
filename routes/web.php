<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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
    return view('user_login');
});

Route::get('/admin', [AdminController::class, 'index']);
Route::post('admin/auth', [AdminController::class, 'adminAuth']);
Route::get('admin/dashboard', [DashboardController::class, 'index']);




//Route::get('login', [UserController::class, 'index']);
//Route::post('user-auth', [UserController::class, 'userAuth']);



