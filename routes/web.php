<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

Route::view('tenant-404', 'errors.tenant.404')->name('tenant.404');

Route::resource('posts', PostController::class);

Route::get('/', function () {
    return view('welcome');
})->middleware('subdomain_main');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/courses', function () {
    return \App\Models\Course::all();
});
