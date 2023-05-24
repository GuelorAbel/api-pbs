<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreatePostRequest extends FormRequest
{
    /**
     * Déterminez si l'utilisateur est autorisé à effectuer cette demande.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la demande.
     *
     * @return array<string,
     */
    public function rules(): array
    {
        return [
            //les règles à respecter pour que les données soient inserer dans la bd
            'title' => 'required' // ceci dit que le titre est obligatoire
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false, //si le titre n'est pas fourni, la soumission est fausse
            'error' => true, // dans ce cas l'erreur existe
            'message' => 'Erreur de validation', //le message de l'erreur
            'errorsList' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'title.required' => 'Un titre est obligatoir pour un article'
        ];
    }
}
