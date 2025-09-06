<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Repositories\User\OfferRepository;

class OfferController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected OfferRepository $offers) {}

    public function index(Request $request): JsonResponse
    {

        $perPage = $request->integer('per_page', 15);
        $offers = $this->offers->query()
            ->with('club')
            ->where('is_active', true)
            ->where('end_at', '>', now())
            ->paginate($perPage);

        if ($offers->isEmpty()) {
            return $this->apiResponse([], 'No offers available', 200);
        }

        return $this->apiResponse(OfferResource::collection($offers), 'success', 200);
    }
}
