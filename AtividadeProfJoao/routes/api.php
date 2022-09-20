<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('posta',[PostController::class,'store']);
Route::get('posta', [PostController::class, 'index']);
Route::get('posta/{id}', [PostController::class, 'show']);
Route::post('posta/editar/{id}', [Postcontroller::class, 'edit']);
Route::delete('posta/deletar/{id}', [PostController::class, 'destroy']);

Route::post('posta/{id}/coment', [CommentController::class, 'store']);
Route::get('coment/{id}', [CommentController::class, 'show']);
Route::get('posta/{id}/coment', [CommentController::class,'index']);
Route::post('coment/editar/{id}', [CommentController::class,'edit']);
Route::delete('coment/deletar/{id}', [CommentController::class, 'destroy']);
