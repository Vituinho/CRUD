<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TasksController::class);
