<?php

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
Route::get('/profil/{id}', [UserController::class, 'profil'])->name('profil.index');

// Modification du profil
Route::put('/profil/{id}', [UserController::class, 'update'])->name('profil.update');

// Création d'une publication
Route::post('/post', [PostController::class, 'store'])->name('post.store');

// Upload de photo
Route::post('/upload', [PostController::class, 'upload'])->name('upload.store');

// Récupération de tout les post
Route::get('/all-post', [PostController::class, 'index'])->name('all-post.index');
