<?php

namespace App\Http\Requests\API\Auth;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Validation\Rules\Enum;
use App\Http\Requests\API\MasterApiRequest;

class SocialRequest extends MasterApiRequest
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
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'provider' => 'required|string|in:facebook,google,apple',
            'type' => ['required', new Enum(UserType::class)],
            'social_id' => 'required|string',
            'device_id' => 'required',
            'token_firebase' => 'required'

        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $email = $this->input('email');
            $type = $this->input('type');

            if ($email && $type) {

                $user = User::where('email', $email)->first();
            if ($user && $user->type !== $type) {
                $validator->errors()->add('email', __('البريد الإلكتروني مستخدم بحساب من نوع مختلف.'));
            }

            }
        });
    }
}
