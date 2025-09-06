<?php

namespace App\Http\Requests\API\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\MasterApiRequest;

class UploadImageRequest extends MasterApiRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
