<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
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

Route::post('login', [AuthController::class, 'signin']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(SchoolController::class)->middleware(['guest'])->prefix('schools')->group(function () {
    Route::get('/', 'index')->name('schools.list');
    Route::get('/{school}', 'show')->name('schools.show');
    Route::post('/', 'store')->name('schools.store');
    Route::put('/{school}', 'update')->name('schools.update');
    Route::delete('/{school}', 'destroy')->name('schools.destroy');
});

Route::controller(StudentController::class)->middleware(['auth:sanctum'])->prefix('students')->group(function () {
    Route::get('/', 'index')->name('students.list');
    Route::get('/{student}', 'show')->name('students.show');
    Route::post('/', 'store')->name('students.store');
    Route::put('/{student}', 'update')->name('students.update');
    Route::delete('/{student}', 'destroy')->name('students.destroy');
});
