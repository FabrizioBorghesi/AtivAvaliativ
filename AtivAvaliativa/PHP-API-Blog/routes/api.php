<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::post('posting',[PostController::class,'store']);
Route::get('posting', [PostController::class, 'index']);
Route::get('posting/{id}', [PostController::class, 'show']);
Route::post('posting/edit/{id}', [Postcontroller::class, 'edit']);
Route::delete('posting/delete/{id}', [PostController::class, 'destroy']);

Route::post('posting/{id}/comment', [CommentController::class, 'store']);
Route::get('comment/{id}', [CommentController::class, 'show']);
Route::get('posting/{id}/comment', [CommentController::class,'index']);
Route::post('comment/edit/{id}', [CommentController::class,'edit']);
Route::delete('comment/delete/{id}', [CommentController::class, 'destroy']);


