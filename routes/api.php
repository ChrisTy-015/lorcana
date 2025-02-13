<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\WishlistController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Routes d'authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);


// Routes des cartes
Route::get('/cards', [CardController::class, 'index']);
Route::get('/cards/{id}', [CardController::class, 'single']);

// Routes des sets
Route::get('/sets', [SetController::class, 'index']);
Route::get('/sets/{id}', [SetController::class, 'single']);
Route::get('/sets/{id}/cards', [SetController::class, 'cards']);

// Routes de la Wishlist (nécessite authentification)
Route::middleware('auth:sanctum')->post('/wishlist/add', [WishlistController::class, 'add']);
Route::middleware('auth:sanctum')->post('/wishlist/remove', [WishlistController::class, 'remove']);
Route::middleware('auth:sanctum')->get('/wishlist', [WishlistController::class, 'list']);

// Récupération des infos utilisateur (nécessite authentification)
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
