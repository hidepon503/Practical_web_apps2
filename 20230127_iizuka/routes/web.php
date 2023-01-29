<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taskcontroller;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;


Route::get('/',[TaskController::class, 'index'])->middleware(['auth'])->name('index');
Route::get('/register',[RegisteredUserController::class, 'create']);
Route::post('/register',[RegisteredUserController::class, 'store']);
Route::get('/login',[AuthenticatedSessionController::class, 'create']);
Route::post('/login',[AuthenticatedSessionController::class, 'store']);
Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'])->middleware(['auth'])->name('logout');
Route::post('/create',[TaskController::class, 'create']);
Route::post('/edit',[TaskController::class, 'edit']);
Route::post('/delete',[TaskController::class, 'delete']);
Route::get('/find',[TaskController::class, 'find']);
Route::get('/search',[TaskController::class, 'search']);
require __DIR__.'/auth.php';
