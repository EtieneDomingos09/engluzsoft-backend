<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    PropertyController,
    PropertyPhotoController,
    FavoriteController,
    FeatureController,
    MessageController,
    VisitController,
    PropertyViewController,
    ReviewController,
    AuthController
};

// ROTAS PÚBLICAS
Route::apiResource('properties', PropertyController::class)->only(['index', 'show']);
Route::get('/features', [FeatureController::class, 'index']);
Route::get('/properties/{id}/photos', [PropertyPhotoController::class, 'index']);
Route::get('/properties/{id}/reviews', [ReviewController::class, 'index']);
Route::get('/properties/{id}/views', [PropertyViewController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);


// ROTAS PROTEGIDAS (autenticado)
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('users', UserController::class);
    Route::apiResource('properties', PropertyController::class)->except(['index', 'show']);

    Route::post('/photos', [PropertyPhotoController::class, 'store']);
    Route::delete('/photos/{id}', [PropertyPhotoController::class, 'destroy']);

    Route::get('/users/{userId}/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::delete('/favorites', [FavoriteController::class, 'destroy']);

    Route::post('/features', [FeatureController::class, 'store']);
    Route::put('/features/{id}', [FeatureController::class, 'update']);
    Route::delete('/features/{id}', [FeatureController::class, 'destroy']);

    Route::get('/users/{userId}/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages/{id}', [MessageController::class, 'show']);
    Route::delete('/messages/{id}', [MessageController::class, 'destroy']);

    Route::get('/users/{userId}/visits', [VisitController::class, 'index']);
    Route::post('/visits', [VisitController::class, 'store']);
    Route::put('/visits/{id}', [VisitController::class, 'update']);
    Route::delete('/visits/{id}', [VisitController::class, 'destroy']);

    Route::post('/views', [PropertyViewController::class, 'store']);

    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});