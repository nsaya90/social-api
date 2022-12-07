<?php

use App\Http\Controllers\DislikeController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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
// Inscription
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// Connexion
Route::post('/login', [UserController::class, 'login'])->name('login');

// Affichage du profil de l'utilisateur connecté
Route::middleware('auth:sanctum')->get('/profil/{id}', [UserController::class, 'profil'])->name('profil.index');

// Modification du profil
Route::middleware('auth:sanctum')->put('/profil/{id}', [UserController::class, 'update'])->name('profil.update');

// Création d'une publication
Route::middleware('auth:sanctum')->post('/post', [PostController::class, 'store'])->name('post.store');

// Upload de photo
Route::post('/upload', [PostController::class, 'upload'])->name('upload.store');

// Récupération de tout les post
Route::middleware('auth:sanctum')->get('/all-post', [PostController::class, 'index'])->name('all-post.index');

// Ajout de like selon id du post
// Route::middleware('auth:sanctum')->post('/likePost/{id}', [LikesController::class, 'likePost'])->name('like.update');

// Ajout de dislike selon id du post
Route::middleware('auth:sanctum')->post('/dislikePost/{id}', [DislikeController::class, 'dislikePost'])->name('dislikePost.update');

// Ajout / Supprésion des likes de chaque post
Route::middleware('auth:sanctum')->post('/like/{id}/{id_post}', [LikesController::class, 'like'])->name('like');

// Récupération des likes de chaque post
Route::middleware('auth:sanctum')->get('/countLike', [LikesController::class, 'countLike'])->name('countLike');

// Verification des likes de chaque user
Route::middleware('auth:sanctum')->get('/showLike/{id}/{id_post}', [LikesController::class, 'showLike'])->name('showLike');
