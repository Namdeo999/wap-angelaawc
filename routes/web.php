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

// Route::get('/', function () {
//     return view('user_login');
// });

Route::get('/admin', [AdminController::class, 'index']);
Route::post('admin/auth', [AdminController::class, 'adminAuth']);

Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('admin/dashboard', [DashboardController::class, 'index']);

    Route::get('admin/wap-admin', [AdminController::class, 'wapAdmin']);
    Route::post('admin/save-admin', [AdminController::class, 'saveAdmin']);
    Route::get('admin/edit-admin/{admin_id}', [AdminController::class, 'editAdmin']);
    Route::post('admin/update-admin/{admin_id}', [AdminController::class, 'updateAdmin']);
    Route::get('admin/delete-admin/{admin_id}', [AdminController::class, 'deleteAdmin']);

    Route::get('admin/wap-user', [UserController::class, 'wapUser']);
    Route::post('admin/save-user', [UserController::class, 'saveUser']);
    Route::get('admin/edit-user/{user_id}', [UserController::class, 'editUser']);
    Route::post('admin/update-user/{user_id}', [UserController::class, 'updateUser']);
    Route::get('admin/delete-user/{user_id}', [UserController::class, 'deleteUser']);




    Route::get('admin/logout', [AdminController::class, 'logout']);
});



Route::get('/', [UserController::class, 'index']);
Route::post('/auth', [UserController::class, 'userAuth']);
Route::group(['middleware'=>'user_auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'userDashboard']);



    Route::get('/user-logout', [UserController::class, 'userLogout']);

});


//Route::get('login', [UserController::class, 'index']);
//Route::post('user-auth', [UserController::class, 'userAuth']);




