<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Post;
use Exception;

class PostController extends Controller
{

    // la méthode qui récupère tous les articles
    public function index()
    {
        try {
            return response()->json([
                'status' => 200,
                'message' => 'les articles sont disponibles',
                'data' => Post::all() //récupération de tous les articles
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // la méthode d'ajout d'un article
    public function store(CreatePostRequest $request)
    {
        try {

            $post = new Post();

            // les données à ajouter
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = auth()->user()->id;
            $post->save(); //c'est l'action qui permet d'ajouter une donnée à la soumission du formulaire

            return response()->json([
                'status' => 200,
                'message' => 'l\'article a été ajouté avec succès',
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // la méthode de mise à jour d'unarticle
    public function update(EditPostRequest $request, Post $post) //Post $post effectue la vérification directemnt,je n'ai donc pas besoin du if(){}else{}
    {
        try {
            // $post = Post::find($post); //il récupère le post passé dynamiquement dans l'URL. Cette ligne a été injectée  partir de Post $post

            // modification des données récupérées
            $post->title = $request->title;
            $post->description = $request->description;
            // je vérifie ici, si le user_id correspond à l''id de l'auteur du post
            if ($post->user_id == auth()->user()->id) {
                $post->save(); //c'est l'action qui modifie les datas à la soumission du formulaire
            } else {
                return response()->json([
                    'status' => 422,
                    'message' => 'Vous n\'êtes pas l\'auteur de cet article. Vous ne pouvez pas le modifier'
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'l\'article a été modifié avec succès',
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // la méthode de suppression
    public function delete(Post $post)  //Post $post effectue la vérification directemnt,je n'ai donc pas besoin du if(){}else{}
    {
        try {
            $post->delete();
            return response()->json([
                'status' => 200,
                'message' => 'l\'article a été supprimé avec succès',
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
