<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tests\TestController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', [TestController::class, 'index']);
Route::get('/', [\App\Http\Controllers\AuthController::class, 'index'])->name('user.home');

Route::prefix('user')->group(function () {
   Route::get('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('user.login');
   Route::post('login/process', [\App\Http\Controllers\AuthController::class, 'processLogin'])->name('user.login.process');
   Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('user.logout');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    Route::get('create', [\App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
    Route::post('store', [\App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
    Route::get('edit/{id}', [\App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
    Route::post('update', [\App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
});
