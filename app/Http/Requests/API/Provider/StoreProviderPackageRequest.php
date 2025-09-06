<?php

namespace App\Http\Requests\API\Provider;

use App\Http\Requests\API\MasterApiRequest;

class StoreProviderPackageRequest extends MasterApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255|min:2',
            'price'      => 'required|numeric|min:1',
            'limit'      => 'required|integer|min:-1',
            'duration'   => 'required|integer|min:1|max:12',
            'type'       => 'required|in:monthly,yearly',
        ];
    }
}
