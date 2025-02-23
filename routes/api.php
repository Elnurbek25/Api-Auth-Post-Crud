<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('posts', [PostController::class, 'store']);
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post}', [PostController::class, 'show']);
    
    Route::put('posts/{post}', [PostController::class, 'update'])->middleware('chekPost');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->middleware('chekPost');

    Route::post('comments', [CommentController::class, 'addComment']);
    Route::delete('comments/{comment}', [CommentController::class, 'deleteComment'])->middleware('checkComment');

    Route::post('logout', [AuthController::class, 'logout']);
});
