<?php

namespace App\Http\Requests\API\User;

use Illuminate\Validation\Rule;
use App\Http\Requests\API\MasterApiRequest;

class StoreUserSubscriptionRequest extends MasterApiRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'provider_package_id' => ['required', 'exists:provider_packages,id'],
            'provider_id'         => ['required', 'exists:users,id'],
            'name'                => ['required', 'string', 'max:255'],
            'phone'               => ['required', 'string', 'max:20'],
            'email'               => ['required', 'email', 'max:255'],
            'gender'              => ['required', Rule::in(['male', 'female', 'other'])],
            'payment_method'      => ['nullable', 'string'],
            'offer_id'            => ['nullable', 'exists:offers,id'],

        ];
    }
}
