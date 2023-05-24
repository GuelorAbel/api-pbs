<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SignupUser extends FormRequest
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
     * @return array<string,
     */
    public function rules(): array
    {
        return [
            //les règles à respecter pour que les données soient inserer dans la bd
            'name' => 'required', // ceci dit que le titre est obligatoire
            'email' => 'required|unique:users,email', // ceci dit que l'email est obligatoire, que l'email doit être unique dans la BDD users
            'password' => 'required' // ceci dit que le mot de passe est obligatoire
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
            'name.required' => 'Le nom est obligatoir',
            'email.required' => 'L\'email est obligatoire',
            'email.unique' => 'Cette adresse email existe déjà',
            'password.required' => 'Un mot de passe est requis'
        ];
    }
}
