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

/*
breezeインストール直後は下記の内容しかない。
このルーティングでwelcome.blade.phpやdashboard.blade.phpを返している。

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

記述を下記の様に変更する事で初期画面をwelcomeからregisterに変え、ログイン後ミドルウェアを介してindexを返している

Route::get('/', function () {
    return view('register');
});

Route::get('/', function () {
    return view('index');
})->middleware(['auth'])->name('index');


が、そもそもこの考え方は誤り。
Route::get('/', ～～～～～での記述がコメントアウト前と合わせると３件目となっており、実際は最後の１件しか動いていない。
つまり
Route::get('/', ～～～～～は１回のみしか使えない。
今回の実装ではtaskcontrollerを使う事、ミドルウェアを利用してログイン画面に遷移し、indexを返すことをが重要。
その為記述は
Route::get('/',[TaskController::class, 'index'])->middleware(['auth'])->name('index');
となる



*/

require __DIR__.'/auth.php';
