<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\MasterApiRequest;

class ResetPasswordRequest extends MasterApiRequest
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
            'email' => 'required|email:rfc,dns|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|exists:users,reset_token_password',
        ];
    }
}