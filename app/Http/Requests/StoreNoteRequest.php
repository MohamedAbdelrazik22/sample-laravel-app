<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    // Anyone can create a note (no auth required for this sample)
    public function authorize()
    {
        return true;
    }

    // Validation rules for creating a note
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ];
    }
}
