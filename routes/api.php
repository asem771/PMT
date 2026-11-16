
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskAssignmentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Route;


// ========================================
// Developer Protected API
// جميع واجهات API محمية
// ========================================

Route::middleware(['web', 'developer.access'])->group(function () {

    // Students
    Route::get('students', [StudentController::class, 'index']);

    Route::get('students/{student}', [StudentController::class, 'show']);

    Route::get('students/{student}/tasks', [StudentController::class, 'tasks']);


    // Categories
    Route::get('categories', [CategoryController::class, 'index']);

    Route::get('categories/{category}', [CategoryController::class, 'show']);

    Route::get('categories/{category}/tasks', [CategoryController::class, 'tasks']);


    // Tasks CRUD
    Route::apiResource('tasks', TaskController::class);


    // Task Assignments
    Route::post('tasks/{task}/students', [TaskAssignmentController::class, 'store']);

    Route::put('tasks/{task}/students', [TaskAssignmentController::class, 'update']);

    Route::delete('tasks/{task}/students/{student}', [TaskAssignmentController::class, 'destroy']);


    // Task Status
    Route::patch('tasks/{task}/status', [TaskStatusController::class, 'update']);

});
