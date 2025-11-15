<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
{
    // Anyone can update a note (no auth required for this sample)
    public function authorize()
    {
        return true;
    }

    // Validation rules for updating a note
    public function rules()
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'content' => 'nullable|string',
        ];
    }
}
