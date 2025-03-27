<?php

namespace App\Http\Requests\Candidature;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidatureRequest extends FormRequest
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
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'lettre_motivation' => 'nullable|string|max:5000',
            'annonce_id' => 'nullable|exists:annonces,id',
        ];
    }
}
