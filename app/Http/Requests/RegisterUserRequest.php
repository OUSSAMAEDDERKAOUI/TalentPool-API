<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    // Détermine si l'utilisateur est autorisé à effectuer cette requête
    public function authorize()
    {
        return true;  // Par défaut, vous pouvez autoriser toutes les requêtes.
    }

    // Définir les règles de validation pour les données
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6', 
            'status' => 'required|string|in:actif,inactif',
            'role' => 'required|string|in:admin,recruteur,candidat',
            'photo' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ];
    }


    
    // Optionnel : Vous pouvez aussi préparer les données avant de les valider (par exemple, nettoyer les entrées ou effectuer des transformations)
    // public function prepareForValidation()
    // {
    //     if ($this->hasFile('photo') && $this->file('photo')->isValid()) {
    //         $this->merge([
    //             'photo' => $this->file('photo')->store('profil_photos', 'public')
    //         ]);
    //     }
    // }
}
