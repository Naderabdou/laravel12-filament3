<?php

namespace App\Http\Requests\API\Provider\Club;

use Illuminate\Foundation\Http\FormRequest;

class StoreClubRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|digits_between:10,15',
            'desc' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
            'gender' => 'required|string|in:male,female',
            'address' => 'required|string|min:2|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
            'schedules' => 'required|array',
            'schedules.*.day' => 'required_with:schedules|string|max:20',
            'schedules.*.time_from' => 'required_with:schedules|date_format:H:i',
            'schedules.*.time_to' => 'required_with:schedules|date_format:H:i|after:time_from',
            'schedules.*.activity_id' => 'nullable|integer|exists:activities,id',
            'schedules.*.trainer' => 'nullable|string|max:255',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048|min:1',
            'activities' => 'nullable|array',
            'activities.*' => 'integer|exists:activities,id',
        ];
    }
}
