<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['throttle:6600,1'])->group(function () {
    Route::post('login',[AuthController::class,'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('users', [AuthController::class, 'getUsers']);
    Route::put('/users/{id}', [AuthController::class, 'updateUser']); // Update user
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser']); // Delete user
    Route::apiResource('schools', App\Http\Controllers\Api\V1\SchoolController::class);
    Route::apiResource('roles', App\Http\Controllers\Api\V1\RoleController::class);
    Route::apiResource('students', App\Http\Controllers\Api\V1\StudentController::class);
    Route::apiResource('parents', App\Http\Controllers\Api\V1\ParentController::class);
    Route::apiResource('teachers', App\Http\Controllers\Api\V1\TeacherController::class);
    Route::apiResource('classes', App\Http\Controllers\Api\V1\NeuroClassController::class);
    //Students Routes
    Route::get('/students', [App\Http\Controllers\Api\V1\StudentController::class, 'index']); // Fetch all therapists with pagination
    Route::get('/students/{id}', [App\Http\Controllers\Api\V1\StudentController::class, 'show']); 
    Route::post('/students', [App\Http\Controllers\Api\V1\StudentController::class, 'store']); 
    Route::put('/students/{id}', [App\Http\Controllers\Api\V1\StudentController::class, 'update']); 
    Route::delete('/students/{id}', [App\Http\Controllers\Api\V1\StudentController::class, 'destroy']);
    Route::post('/student/report', [App\Http\Controllers\Api\V1\StudentController::class, 'storeReport']); // Create a new therapist
    //Therapist Routes
    Route::get('/therapists', [App\Http\Controllers\Api\V1\TherapistController::class, 'index']); // Fetch all therapists with pagination
    Route::get('/therapists/{id}', [App\Http\Controllers\Api\V1\TherapistController::class, 'show']); // Fetch a single therapist by ID
    Route::post('/therapists', [App\Http\Controllers\Api\V1\TherapistController::class, 'store']); // Create a new therapist
    Route::put('/therapists/{id}', [App\Http\Controllers\Api\V1\TherapistController::class, 'update']); // Update an existing therapist
    Route::delete('/therapists/{id}', [App\Http\Controllers\Api\V1\TherapistController::class, 'destroy']); // Delete a therapist
    //Therapist Categories Routes
    Route::apiResource('/therapy-categories', App\Http\Controllers\Api\V1\TherapyCategoryController::class);
});
