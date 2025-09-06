<?php

namespace App\Http\Controllers\API;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserSubscriptionResource;
use App\Repositories\User\UserSubscriptionRepository;
use App\Repositories\Provider\ProviderPackageRepository;
use App\Http\Requests\API\User\StoreUserSubscriptionRequest;
use Illuminate\Support\Facades\DB;

class UserSubscriptionController extends Controller
{
    use ApiResponseTrait;


    public function __construct(protected UserSubscriptionRepository $repository, protected ProviderPackageRepository $providerPackageRepository) {}

    public function index(): JsonResponse
    {
        $subscriptions = $this->repository->getUserSubscriptions(auth()->id());
        return $this->ApiResponse(
            UserSubscriptionResource::collection($subscriptions),
            __('Subscriptions retrieved successfully'),
            200
        );
    }

    // public function store(StoreUserSubscriptionRequest $request)
    // {
    //     $data = $request->validated();
    //     $package = $this->providerPackageRepository->withCount('subscriptions')->find($data['provider_package_id']);

    //     if ($package->limit !== null && $package->subscriptions_count >= $package->limit) {
    //         return $this->ApiResponse(
    //             null,
    //             'This package has reached its subscription limit.',
    //             400
    //         );
    //     }

    //     $data['user_id'] = auth()->id();

    //     if (!isset($data['order_number'])) {
    //         $data['order_number'] = 'ORD-' . uniqid();
    //     }

    //     $subscription = $this->repository->create($data);

    //     return $this->ApiResponse(
    //         new UserSubscriptionResource($subscription),
    //         'Subscription created successfully',
    //         201
    //     );
    // }




    public function store(StoreUserSubscriptionRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();

            $package = $this->providerPackageRepository
                ->query()
                ->withCount('subscriptions')
                ->where('id', $data['provider_package_id'])
                ->lockForUpdate()
                ->first();

            if ($package->limit !== null && $package->subscriptions_count >= $package->limit) {
                return $this->ApiResponse(
                    null,
                    __('This package has reached its subscription limit.'),
                    400
                );
            }

            $data['user_id'] = auth()->id();
            $data['total_price'] = $package->price;
            $data['order_number'] = 'order_' . substr(uniqid(), -6);
            $data['start_date'] = now();
            $data['end_date'] = $this->repository->calculateEndDate($package->type, $package->duration);

            $subscription = $this->repository->create($data);

            $subscription->refresh();

            return $this->ApiResponse(
                new UserSubscriptionResource($subscription),
                __('Subscription created successfully'),
                201
            );
        });
    }

}