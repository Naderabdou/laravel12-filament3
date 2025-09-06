<?php

namespace App\Http\Controllers\API\Provider\PackageSubscription;

use App\Models\Club;
use App\Models\Package;
use App\Models\Provider;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProviderSubscription;
use App\Repositories\Provider\Package\PackageRepository;
use App\Repositories\Provider\PackageSubscription\PackageSubscriptionRepository;
use App\Http\Requests\Api\Provider\PackageSubscription\StorePackageSubscriptionRequest;

class PackageSubscriptionController extends Controller
{
    use ApiResponseTrait;
    public function __construct(protected PackageSubscriptionRepository $packageSubscriptions, protected PackageRepository $packagesRepository) {}

    public function store(StorePackageSubscriptionRequest $request): JsonResponse
    {
        $package = $this->packagesRepository->find($request->package_id);

        $inActiveSubscription = $this->packageSubscriptions->inActiveSubscription($package->id);

        if ($inActiveSubscription) {
            return $this->ApiResponse(
                __('You already have subscription for this package , please wait until it actives'),
                422
            );
        }

        $activeSubscription = $this->packageSubscriptions->activeSubscription($package->id);
        if ($activeSubscription) {
            return $this->ApiResponse(
                __('You already have an active subscription for this package'),
                422
            );
        }

        return DB::transaction(function () use ($request, $package) {
            $user = auth()->user();
            $user->lockForUpdate();
            $data = $request->validated();
            $data['provider_id'] = $user->id;
            $data['total_price'] = $package->price;
            $data['order_number'] = 'order_' . substr(uniqid(), -6);
            $data['start_date'] = now();
            $data['end_date'] = $this->packageSubscriptions->calculateEndDate($package->type, $package->duration);
            $this->packageSubscriptions->store($data);
            return $this->ApiResponse(null, __('Package subscription created successfully'), 201);
        });
    }
}
