<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubdomainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Webhook\WebhookController;
use App\Http\Controllers\Webhook\GuruController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::view('404', 'errors.tenant.404')->name('tenant.404');

Route::group(['prefix' => '', 'namespace' => '', 'middleware' => ['auth', 'subdomain_user', 'user_isAdmin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('courses', CourseController::class);

    Route::post('courses/modules/store', [ModuleController::class, 'store'])->name('modules.store');
    Route::any('courses/{course_id}/modules/{moduleId}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('courses/modules/{module_id}/update', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('courses/modules/destroy/{module_id}', [ModuleController::class, 'destroy'])->name('modules.destroy');

    Route::get('courses/{course_id}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('courses/modules/lessons/store', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('courses/{course_id}/modules/{module_id}/lesson/{lesson_id}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('courses/lesson/{lesson_id}/update', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('courses/lesson/destroy/{lesson_id}', [LessonController::class, 'destroy'])->name('lessons.destroy');

    Route::resource('users', UserController::class);

    Route::resource('webhooks', WebhookController::class);
});


//Webhooks Receive
Route::group(['prefix' => 'webhook'], function () {
    Route::post('guru/{id}', [GuruController::class, 'index']);
});


//Login
Route::group(['prefix' => 'sub'], function () {
    Route::get('verification', [SubdomainController::class, 'index'])->name('sub.login');
    Route::post('verification', [SubdomainController::class, 'verification'])->name('sub.verification');
});

Route::get('/phpinfo', function () {
    return phpinfo();
});
