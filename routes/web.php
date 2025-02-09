<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[PageController::class,'index'])->name('index');
Route::get('/login',[AuthController::class,'showlogin'])->name('showlogin');
Route::post('/login',[AuthController::class,'postlogin'])->name('postlogin');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'Postregister'])->name('postregister');
Route::get('logout',[AuthController::class, 'logout'])->name('logout');
Route::get('/create-article',[PageController::class,'createArticle'])->name('createArticle');
Route::post('/create-article',[PageController::class,'postArticle'])->name('postArticle');
Route::get('/category/{slug}',[PageController::class,'articleByCategory'])->name('articleByCategory');
Route::get('/language/{slug}',[PageController::class,'articleBylanguage'])->name('articleBylanguage');
Route::get('/article/{slug}',[PageController::class,'articledetail']);
Route::get('/article/like/{id}',[PageController::class,'createLike']);
Route::post('/comment/create',[PageController::class,'createcomment']);