<?php

namespace App\Http\Requests\API\Auth;

use App\Enums\UserType;
use Illuminate\Validation\Rules\Enum;
use App\Http\Requests\API\MasterApiRequest;

/**
 * @property string $email
 * @property string $password
 * @property string $device_id
 * @property string $token_firebase
 */
class LoginRequest extends MasterApiRequest
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
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50'
            ],
            'device_id' => 'required',
            'token_firebase' => 'required',
            'type' => ['required', new Enum(UserType::class)],
            'password' => ['required', 'string', 'min:8'],
            'device_id' => 'required',
            'token_firebase' => 'required'
        ];
    }
}
