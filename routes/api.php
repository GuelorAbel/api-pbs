<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| C'est ici que vous pouvez enregistrer des routes d'API pour votre application. Ces
| les routes sont chargées par le RouteServiceProvider au sein d'un groupe qui
| se voit attribuer le groupe middleware "api". Amusez-vous à créer votre API !
|
*/

// le client consommera les données de l'API via www.mon-domaine/api/....

// récupérer la liste des articles
Route::get('posts', [PostController::class, 'index']);

// ajouter un article dans la base de données, on oeut utiliser POST | PUT | PATCH
Route::post('posts/create', [PostController::class, 'store']);

// mettre à jour un article
Route::put('posts/edit/{post}', [PostController::class, 'update']);

// supprimer un article
Route::delete('posts/{post}', [PostController::class, 'delete']);

// c'est une route est protégée, elle retourne l'utilisateur connecté
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
