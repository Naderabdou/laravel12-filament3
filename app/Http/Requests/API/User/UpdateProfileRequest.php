<?php

namespace App\Http\Requests\API\User;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\MasterApiRequest;

class UpdateProfileRequest extends MasterApiRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $userId = Auth::id();

        return [
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('users','email')->ignore($userId)],
            'phone' => ['required','string','max:20',Rule::unique('users','phone')->ignore($userId)],
        ];
    }
}
