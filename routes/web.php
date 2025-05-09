<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
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

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [TaskController::class, 'viewAll'])->middleware('auth')->name('Task.view');

Route::get('/create',[TaskController::class, 'task'])->middleware('auth');
Route::post('/create', [TaskController::class, 'createTask'])->middleware('auth');
Route::get('/update/{id}',[TaskController::class, 'updateTask'])->middleware('auth');
Route::patch('/update/{id}', [TaskController::class, 'storeUpdatedTask'])->middleware('auth');
Route::delete('/delete/{id}', [TaskController::class, 'deleteTask'])->middleware('auth');











// Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// //Update User Details
// Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
// Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
