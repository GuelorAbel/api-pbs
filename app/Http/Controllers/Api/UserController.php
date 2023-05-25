<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\SignupUser;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // la méthode qui gère la création d'un compte utlisateur
    public function signup(SignupUser $request)
    {
        try {

            $user = new User();

            // récupération des données saisies dans le formulaire
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password, [
                'rounds' => 12
            ]);
            $user->save(); //action qui permet de créer l'utilisateur à la soumission du formulaire

            return response()->json([
                'status' => 200,
                'message' => "Le compte associé à $user->name a été créé.",
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // la méthode qui gère la connexion de l'utilisateur
    public function login(LoginUserRequest $request)
    {
        // Je compare les données de l'utilisateur avec les données qui rentrent(auth()->attempt())
        if (auth()->attempt($request->only(['email', 'password']))) {
            // si l'utilisateur existe, applique ce qui suit
            $user = auth()->user(); //Là,je récupère les infos du user qui tente de se connecter
            $token = $user->createToken('CLE_SECRETE')->plainTextToken;

            return response()->json([
                'status' => 200,
                'message' => "Vous êtes connecté à votre compte...",
                'user' => $user,
                'token' => $token
            ]);
        } else {
            // si  les informations fournies ne correspondent à aucun utilisateur applique ce qui suit
            return response()->json([
                'status' => 403,
                'message' => "Les informations renseignées ne correspondent à aucun utilisateur",
            ]);
        }
    }
}
