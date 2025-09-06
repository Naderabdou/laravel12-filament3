<?php

namespace App\Http\Requests\API\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\MasterApiRequest;

class ChangePasswordRequest extends MasterApiRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required' , 'current_password'],
            'password' => ['required', 'string', 'min:8', 'max:50', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,50}$/u', 'confirmed'],
        ];
    }
}
