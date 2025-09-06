<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\MasterApiRequest;
/**
 * @property string $email
 * @property string $code
 */
class CheckCodeRequest extends MasterApiRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc,dns|exists:users,email',
            'code' => 'required|string|size:6',
        ];
    }
}