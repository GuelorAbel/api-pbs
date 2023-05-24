<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Post;
use Exception;

class PostController extends Controller
{

    // le controller qui récupère tous les articles
    public function index()
    {
        try {
            return response()->json([
                'status' => 200,
                'message' => 'les articles sont disponibles',
                'data' => Post::all()
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // le controller d'ajout d'un article
    public function store(CreatePostRequest $request)
    {
        try {

            $post = new Post();

            // les données à ajouter
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();

            return response()->json([
                'status' => 200,
                'message' => 'l\'article a été ajouté avec succès',
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // le controller de mise à jour d'unarticle
    public function update(EditPostRequest $request, Post $post)
    {
        try {
            // $post = Post::find($post); //il récupère le post passé dynamiquement dans l'URL. Cette ligne a été injectée  partir de Post $post

            // modification des données récupérées
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();

            return response()->json([
                'status' => 200,
                'message' => 'l\'article a été modifié avec succès',
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // le controller de suppression
    public function delete(Post $post)
    {
        try {
            $post->delete();
            return response()->json([
                'status' => 200,
                'message' => 'l\'article a été supprimé avec succès'
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
