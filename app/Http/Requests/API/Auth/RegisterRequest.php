<?php

namespace App\Http\Requests\API\Auth;

use App\Enums\UserType;
use Illuminate\Validation\Rules\Enum;
use App\Http\Requests\API\MasterApiRequest;

/**
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property float $lat
 * @property float $lng
 * @property enum $gender
 * @property string $device_id
 * @property string $token_firebase
 * @property enum $type
 * @property string $password
 */
class RegisterRequest extends MasterApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email|max:255',
            'phone' => 'required|string|unique:users,phone|digits_between:10,20',
            'address' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'gender' => 'required|string|in:male,female',
            'type' => ['required', new Enum(UserType::class)],
            'device_id' => 'required',
            'token_firebase' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/u',
                'confirmed'
            ],

        ];
    }
}
