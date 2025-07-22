<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);
Route::resource('tasks', TaskController::class)->except(['show', 'create']);
Route::post('tasks/update-order', [TaskController::class, 'updateOrder']);
