<?php

namespace App\Http\Controllers\API;

use App\Models\Onboarding;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\OnboardingResource;

class OnboardingController extends Controller
{
    use ApiResponseTrait;

    public function index(): JsonResponse
    {
        $onboardings = Onboarding::get();
        return $this->ApiResponse(OnboardingResource::collection($onboardings));
    }
}
