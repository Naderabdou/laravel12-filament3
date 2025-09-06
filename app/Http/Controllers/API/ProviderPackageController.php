<?php

namespace App\Http\Controllers\API;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Models\ProviderPackage;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Provider\ProviderPackageResource;
use App\Repositories\Provider\ProviderPackageRepository;
use App\Http\Resources\Provider\UserSubscriptionsResource;
use App\Http\Requests\API\Provider\StoreProviderPackageRequest;

class ProviderPackageController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected ProviderPackageRepository $providerPackageRepository) {}


    public function index(Request $request): JsonResponse
    {
        $packages = ProviderPackage::withCount('subscriptions')->get();
        $perPage = $request->intger('per_page', 15);
        $packages = $this->providerPackageRepository->query()
            ->withCount('subscriptions')
            ->where('provider_id', auth()->id())
            ->paginate($perPage);

        return $this->ApiResponse(
            ProviderPackageResource::collection($packages),
            'Packages retrieved successfully',
            200
        );
    }


    public function store(StoreProviderPackageRequest $request): JsonResponse
    {
        $data = $request->validated();
        $provider = Provider::find(auth()->id());
        $data['provider_id'] = $provider->id;
        $data['club_id'] = $provider->club->id;

        $this->providerPackageRepository->store($data);

        return $this->ApiResponse(
            null,
            'Package created successfully',
            201
        );
    }


    public function getUserSubscribers(int $packageId, Request $request): JsonResponse
    {

        $provider = Provider::find(auth()->id());
        if (!$provider->providerPackages()->where('id', $packageId)->exists()) {
            return $this->ApiResponse(null, 'Provider not found', 404);
        }
        $search = $request->string('search');
        $package = $this->providerPackageRepository->whereHas('subscriptions', function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })->find($packageId);

        if (!$package) {
            return $this->ApiResponse(null, 'Package not found', 404);
        }

        return $this->ApiResponse(
            UserSubscriptionsResource::collection($package->subscriptions),
            'Subscribers retrieved successfully',
            200
        );
    }

    // public function changeUserSubscriptionStatus(int $subscriptionId, string $status): JsonResponse
    // {
    //     $providerId = auth()->id();



    //     $updated = $this->providerPackageRepository->updateStatusByProvider($subscriptionId, $providerId, $status);

    //     if (!$updated) {
    //         return $this->ApiResponse(null, 'Subscription not found', 404);
    //     }

    //     return $this->ApiResponse(null, 'Subscription status updated successfully', 200);
    // }


    public function toggleStatus(int $packageId): JsonResponse
    {
        $this->providerPackageRepository->toggleIsActive($packageId);
        return $this->ApiResponse(null, 'Package status updated successfully', 200);
    }
}
