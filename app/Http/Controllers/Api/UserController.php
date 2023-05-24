<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(SignupUser $request)
    {
        try{

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
        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
