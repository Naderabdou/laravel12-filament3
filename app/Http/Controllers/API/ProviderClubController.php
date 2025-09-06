<?php

namespace App\Http\Controllers\API;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Provider\ProviderClubResource;
use App\Repositories\Provider\ProviderClubRepository;

class ProviderClubController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected ProviderClubRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index(): JsonResponse
    {
        $providerId = auth()->id();


        $search = request()->query('search');

        $subscribers = $this->repository->getSubscribersByProvider($providerId, $search);

        return $this->ApiResponse(
            ProviderClubResource::collection($subscribers),
            'Subscribers retrieved successfully',
            200
        );
    }

    public function changeSubscriptionStatus(int $subscriptionId, string $status): JsonResponse
    {
        $providerId = auth()->id();

        if (!$providerId) {
            return $this->ApiResponse(null, 'Unauthorized', 401);
        }

        $updated = $this->repository->updateStatusByProvider($subscriptionId, $providerId, $status);

        if (!$updated) {
            return $this->ApiResponse(null, 'Subscription not found', 404);
        }

        return $this->ApiResponse(null, 'Subscription status updated successfully', 200);
    }
}
