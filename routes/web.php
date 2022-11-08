<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::view('tenant-404', 'errors.tenant.404')->name('tenant.404');

Auth::routes();

Route::group(['prefix' => '', 'namespace' => '', 'middleware' => ['auth', 'subdomain_user']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('courses', CourseController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return view('welcome');
})->middleware('subdomain_user');
