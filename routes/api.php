<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/sign-in', [UserController::class, 'signIn']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout/{user}', [UserController::class, 'logout']);
Route::post('/forgot-password', [UserController::class, 'forgot_password']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('category')->group(function () {
        Route::post('/create', [CategoryController::class, 'create']);
        Route::get('/list', [CategoryController::class, 'index']);
        Route::post('/{id}/update', [CategoryController::class, 'update']);
        Route::post('/{id}/delete', [CategoryController::class, 'delete']);
    });

    Route::prefix('sub-category')->group(function () {
        Route::post('/create', [SubCategoryController::class, 'create']);
        Route::get('/list', [SubCategoryController::class, 'index']);
        Route::post('/{id}/update', [SubCategoryController::class, 'update']);
        Route::post('/{id}/delete', [SubCategoryController::class, 'delete']);
    });

    Route::post('/change-password/{user}', [UserController::class, 'change_password']);
});
