<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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
    $viewmodel = ['title' => 'Home Page'];
    return view('pages.home', $viewmodel);
});

Route::get('/book' , [BookController::class,'index']);
Route::get('/book/add' , [BookController::class,'add']);
Route::post('/book' , [BookController::class,'add_post']);
Route::get('/book/edit/{id}' , [BookController::class,'edit']);
Route::post('/book/edit/{id}' , [BookController::class,'edit_post']);
Route::get('/book/{id}', [BookController::class,'details']);
Route::delete('/book/{id}', [BookController::class,'delete']);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
