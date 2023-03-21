<?php

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

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/tasks', function () {
    return view('tasks');
})->name('tasks');

Route::middleware(['auth:sanctum', 'verified'])->get('/task_groups', function () {
    return view('task_groups');
})->name('task_groups');
