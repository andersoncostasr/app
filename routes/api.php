<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Webhook\GuruController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth', [AuthController::class, 'auth']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/courses', [CourseController::class, 'index'])->name('api.courses.index')->middleware('auth:sanctum', 'subdomain_user');

Route::group(['middleware' => ['auth:sanctum', 'subdomain_user']], function () {
    Route::get('/categories', [CourseController::class, 'categories'])->name('api.categories.index');
    Route::get('/courses', [CourseController::class, 'index'])->name('api.courses.index');
    Route::get('/course/{id}', [CourseController::class, 'show'])->name('api.courses.show');
    Route::get('/course/{id}/modules', [CourseController::class, 'modules'])->name('api.courses.modules');
    Route::get('/course/module/{id}/lessons', [CourseController::class, 'lessons'])->name('api.courses.lessons');
    Route::get('/course/module/lesson/{id}', [CourseController::class, 'lesson'])->name('api.courses.lesson');
    Route::get('/course/module/lesson/{id}/attacchments', [CourseController::class, 'attacchments'])->name('api.courses.lesson.attacchments');
});
