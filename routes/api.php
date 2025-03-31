<?php

use Illuminate\Support\Facades\Route;



//Google Auth
use App\Http\Controllers\Api\GoogleController;

Route::post('/auth/google/callback', [GoogleController::class, 'login']);

// Authentification
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/check-auth', [AuthController::class, 'checkAuth']);

// User
use App\Http\Controllers\Api\UsersController;

Route::middleware('auth:sanctum')->get("/users/all", [UsersController::class, 'index']);

Route::middleware('auth:sanctum')->get("/users/{user_id}", [UsersController::class, 'show']);
Route::middleware('auth:sanctum')->delete("/users/{user_id}", [UsersController::class, 'delete']);
Route::middleware('auth:sanctum')->patch("/users/{user_id}", [UsersController::class, 'patch']);

Route::middleware('auth:sanctum')->get("/users/{user_id}/comments", [UsersController::class, 'comments']);
Route::middleware('auth:sanctum')->get("/users/{user_id}/recipes", [UsersController::class, 'recipes']);
Route::middleware('auth:sanctum')->get("/users/{user_id}/favoris", [UsersController::class, 'favoris']);

// Recipes
use App\Http\Controllers\Api\RecipesController;

Route::middleware('auth:sanctum')->get("/recipes/all", [RecipesController::class, 'index']);

Route::middleware('auth:sanctum')->get("/recipes/{recipe_id}", [RecipesController::class, 'show']);
Route::middleware('auth:sanctum')->post("/recipes", [RecipesController::class, 'create']);
Route::middleware('auth:sanctum')->delete("/recipes/{recipe_id}", [RecipesController::class, 'delete']);
Route::middleware('auth:sanctum')->patch("/recipes/{recipe_id}", [RecipesController::class, 'patch']);

// Comments
use App\Http\Controllers\Api\CommentController;

Route::middleware('auth:sanctum')->get("/comments/all", [CommentController::class, 'index']);
Route::middleware('auth:sanctum')->get("/comments/pending", [CommentController::class, 'pending']);

Route::middleware('auth:sanctum')->post("/comments", [CommentController::class, 'create']);
Route::middleware('auth:sanctum')->patch("/comments/{comment_id}", [CommentController::class, 'patch']);

// Favoris
use App\Http\Controllers\Api\FavoriController;

Route::middleware('auth:sanctum')->post("/favoris", [FavoriController::class, 'show']);

Route::middleware('auth:sanctum')->put("/favoris", [FavoriController::class, 'add']);
Route::middleware('auth:sanctum')->delete('/favoris/{recipe_id}', [FavoriController::class, 'remove']);

// Media
use App\Http\Controllers\Api\ImageController;

Route::middleware('auth:sanctum')->post('/upload', [ImageController::class, 'upload']);