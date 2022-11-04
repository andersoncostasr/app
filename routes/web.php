<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::view('tenant-404', 'errors.tenant.404')->name('tenant.404');

Route::resource('posts', PostController::class);

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('subdomain_main');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::get('/courses', function () {
    return \App\Models\Course::all();
});
