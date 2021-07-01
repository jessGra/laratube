<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;

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

Route::get('/', [VideoController::class, 'index'])->name('home');

Route::get('/video/subir', [VideoController::class, 'create'])->name('video.subir');
Route::get('/videos/{video}',[VideoController::class, 'show'])->name('video.show');
Route::post('/video/subido', [VideoController::class, 'store'])->name('video.subido');
Route::get('/videos/{video}/editar', [VideoController::class, 'edit'])->name('video.edit');
Route::patch('/videos/{video}', [VideoController::class, 'update'])->name('video.update');
Route::patch('/videos/{video}/eliminar', [VideoController::class, 'delete'])->name('video.delete');

Route::get('/buscar/{search?}/{filter?}', [VideoController::class, 'search'])->name('video.search');

Route::get('/miniatura/{filename}', [VideoController::class, 'getImage'])->name('get.image');
Route::get('/video/{filename}', [VideoController::class, 'getVideo'])->name('get.video');

Route::post('comentario/comentar/{video}', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');
Route::delete('comentario/eliminar/{video}/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('auth');

Route::get('/usuario/{usuario}', [UserController::class, 'show'])->name('user.show');