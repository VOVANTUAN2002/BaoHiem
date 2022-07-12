<?php

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

Route::group([
    'prefix' => 'administrator',
    'middleware' => ['auth']
], function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');

    Route::prefix('products')->group(function () {
        Route::get('/trash', [ProductController::class, 'trashedItems'])->name('products.trash');
        Route::delete('/force_destroy/{id}', [ProductController::class, 'force_destroy'])->name('products.force_destroy');
        Route::get('/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    });

    Route::resource('products', ProductController::class);
});

Route::get('administrator/login', [AuthController::class, 'login'])->name('login');
Route::get('administrator/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('administrator/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');