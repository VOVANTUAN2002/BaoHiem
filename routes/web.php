<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\UserGroupController;
use Illuminate\Support\Facades\Route;

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

// Route::group([
//     'prefix' => 'administrator',
//     'middleware' => ['auth']
// ], function () {
Route::get('/', [IndexController::class, 'index'])->name('admin.index');

//     Route::prefix('insurances')->group(function () {
//         Route::get('/trash', [InsuranceController::class, 'trashedItems'])->name('insurances.trash');
//         Route::delete('/force_destroy/{id}', [InsuranceController::class, 'force_destroy'])->name('insurances.force_destroy');
//         Route::get('/restore/{id}', [InsuranceController::class, 'restore'])->name('insurances.restore');
//     });


Route::prefix('userGroups')->group(function () {
    Route::get('/trash', [UserGroupController::class, 'trashedItems'])->name('userGroups.trash');
    Route::delete('/force_destroy/{id}', [UserGroupController::class, 'force_destroy'])->name('userGroups.force_destroy');
    Route::get('/restore/{id}', [UserGroupController::class, 'restore'])->name('userGroups.restore');
});
Route::resource('userGroups', UserGroupController::class);
Route::resource('users', UserController::class);
Route::resource('insurances', InsuranceController::class);
// });

Route::get('administrator/login', [AuthController::class, 'login'])->name('login');
Route::get('administrator/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('administrator/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
