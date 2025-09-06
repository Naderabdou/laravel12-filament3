<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Provider\ProviderProfileRepository;
use App\Http\Resources\Provider\ProviderProfileResource;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponseTrait;

class ProviderProfileController extends Controller
{
    use ApiResponseTrait;

    protected ProviderProfileRepository $repository;

    public function __construct(ProviderProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * عرض بيانات البروفايدر مع النوادي المرتبطة به
     */
    public function show(): JsonResponse
    {
        $providerId = auth()->id();

        if (!$providerId) {
            return $this->ApiResponse(null, 'Unauthorized', 401);
        }

        $provider = $this->repository->getProviderWithClubs($providerId);

        if (!$provider) {
            return $this->ApiResponse(null, 'Provider not found', 404);
        }

        return $this->ApiResponse(
            new ProviderProfileResource($provider),
            'Provider profile retrieved successfully',
            200
        );
    }
}
