<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends MasterApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'club_id' => 'required|exists:clubs,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:2|max:1000',
        ];
    }
}
