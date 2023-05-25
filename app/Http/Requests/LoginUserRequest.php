<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //les règles à respecter pour que les données soient inserer dans la bd
            'email' => 'required|email|exists:users,email', // ceci dit que l'email est obligatoire, que l'email doit être de type email,qu'il doit exister dans la table users dans la colone email
            'password' => 'required' // ceci dit que le mot de passe est requis
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false, //si le titre n'est pas fourni, la soumission est fausse
            'statud' => 422,
            'error' => true, // dans ce cas l'erreur existe
            'message' => 'Erreur de validation', //le message de l'erreur
            'errorsList' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'email.required' => 'Email non fourni',
            'email.email' => 'Cette adresse email n\'est pas valide',
            'email.exists' => 'L\'email saisi n\'existe pas',
            'password.required' => 'Mot de passe non fourni'
        ];
    }
}
