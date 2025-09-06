<?php

namespace App\Http\Controllers\API\Provider;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Provider\OfferResource;
use App\Repositories\Provider\OfferRepository;
use App\Http\Resources\Provider\ProviderPackageResource;
use App\Repositories\Provider\ProviderPackageRepository;


class HomeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected OfferRepository $offerRepo, protected ProviderPackageRepository $packageRepo) {}




    public function getStatistics(): JsonResponse
    {
        $provider = Provider::withCount(['offers', 'providerPackages', 'userSubscriptions'])->find(auth()->id());

        $statistics = [
            'offers_count' => $provider->offers_count,
            'packages_count' => $provider->provider_packages_count,
            'user_subscriptions_count' => $provider->user_subscriptions_count,
        ];

        return $this->apiResponse($statistics, 'Statistics fetched successfully', 200);
    }

    public function getOffers()
    {
        $providerId = auth()->id();

        $offers = $this->offerRepo->query()->where('provider_id', $providerId)->withCount('subscriptions')->take(1)->get();

        if ($offers->isEmpty()) {
            return $this->apiResponse([], 'No offers available', 200);
        }

        return $this->apiResponse(OfferResource::collection($offers), 'success', 200);
    }

    public function getPackages(): JsonResponse
    {

        $packages = $this->packageRepo->query()->where('provider_id', auth()->id())->withCount('subscriptions')->take(1)->get();

        if ($packages->isEmpty()) {
            return $this->apiResponse([], 'No packages available', 200);
        }

        return $this->apiResponse(ProviderPackageResource::collection($packages), 'success', 200);
    }
}
