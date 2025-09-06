<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClubResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\CategoryResource;
use App\Repositories\User\ClubRepository;
use App\Repositories\User\OfferRepository;
use App\Repositories\User\CategoryRepository;

class HomeController extends Controller
{
    use ApiResponseTrait;


    public function __construct(protected OfferRepository $offers, protected CategoryRepository $categories, protected ClubRepository $clubs) {}

    public function latestOffers(Request $request): JsonResponse
    {
        $limit = $request->integer('limit', 5);
        $offers = $this->offers->query()
            ->with('club')
            ->orderBy('created_at', 'desc')
            ->where('is_active', true)
            ->where('end_at', '>', now())
            ->limit($limit)
            ->get();

        if ($offers->isEmpty()) {
            return $this->apiResponse([], 'No offers available', 200);
        }

        return $this->apiResponse(OfferResource::collection($offers), 'success', 200);
    }

    public function categories(Request $request): JsonResponse
    {
        $limit = $request->integer('limit', 5);
        $search = $request->string('search');
        $categories = $this->categories
            ->query()
            ->when(
                $search,
                fn($query) =>
                $query->where('name_ar', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
            )
            ->limit($limit)
            ->get();
        if ($categories->isEmpty()) {
            return $this->apiResponse([], 'No categories available', 200);
        }
        return $this->apiResponse(CategoryResource::collection($categories), 'success', 200);
    }



    public function nearbyClubs(Request $request): JsonResponse
    {
        $limit = $request->integer('limit', 5);
        $clubs = $this->clubs->query()
            ->with('address', 'images')
            ->withAvg('reviews', 'rating')
            ->limit($limit)
            ->get();

        if ($clubs->isEmpty()) {
            return $this->apiResponse([], 'No clubs available', 200);
        }
        return $this->apiResponse(ClubResource::collection($clubs), 'success', 200);
    }
}
