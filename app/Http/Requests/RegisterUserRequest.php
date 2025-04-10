<?php
// 


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    // Détermine si l'utilisateur est autorisé à effectuer cette requête
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6', 
            'status' => 'nullable|string|in:actif,inactif',
            'role' => 'required|string|in:admin,recruteur,candidat',
            'photo' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'company' => 'nullable|string',
            'poste' => 'nullable|string',
            'sector' => 'nullable|string',
            'city' => 'nullable|string',
            'bio' => 'nullable|string',
            'fonction' => 'nullable|string',
            'niveau' => 'nullable|string',
            'experience' => 'nullable|string',
        ];

        $role = $this->input('role');  

        if ($role === 'recruteur') {
            $rules['company'] = 'required|string|max:255';  
            $rules['sector'] = 'required|string|max:255'; 
            $rules['poste'] = 'required|string|max:255';
            $rules['city'] = 'required|string|max:255';  
        }

        if ($role === 'candidat') {
            $rules['niveau'] = 'required|string|max:255';  
            $rules['experience'] = 'required|string|max:255';  
            $rules['bio'] = 'required|string|max:500'; 
            $rules['fonction'] = 'required|string|max:500'; 
        }

        return $rules;
    }
}
