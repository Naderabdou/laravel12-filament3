<?php

namespace App\Http\Requests\API\Provider;

use App\Http\Requests\API\MasterApiRequest;

class OfferRequest extends MasterApiRequest
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
            'package_id' => 'required|exists:provider_packages,id,provider_id,' . auth()->id(),
            'name' => 'required|string|min:3|max:255',
            'discount' => 'required|numeric|min:1|max:100',
            'end_at' => 'required|date|after:now',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
        ];
    }
}
