<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupUser;
use App\Models\User;

class UserController extends Controller
{
    public function signup(SignupUser $request)
    {
        $user = new User();

        // récupération des données saisies dans le formulaire
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save(); //action qui permet de créer l'utilisateur à la soumission du formulaire
    }
}
