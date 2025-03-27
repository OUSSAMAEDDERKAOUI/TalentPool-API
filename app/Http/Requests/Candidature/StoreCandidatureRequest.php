<?php

namespace App\Http\Requests\Candidature;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'lettre_motivation' => 'required|string|max:5000',
            'annonce_id' => 'required|exists:annonces,id',
            'status' => 'nullable|in:en_attente,accepté,refusé',
        ];
    }
}
