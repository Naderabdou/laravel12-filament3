<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClubResource;
use App\Repositories\User\ClubRepository;
use App\Http\Resources\ClubDetailsResource;

class ClubController extends Controller
{
    use ApiResponseTrait;


    public function __construct(protected ClubRepository $clubs) {}


    public function getCategoryClubs(int $id, Request $request): JsonResponse
    {

        $perPage = $request->integer('per_page', 15);
        $filters = collect($request->only(['search', 'gender', 'rating']))
            ->filter(fn($value) => filled($value))
            ->all();
        $clubs = $this->clubs->query()
            ->where('category_id', $id)
            ->with(['images', 'address', 'reviews'])
            ->filter($filters)
            ->withAvg('reviews', 'rating')
            ->paginate($perPage);

        if ($clubs->isEmpty()) {
            return $this->apiResponse([], 'No clubs available', 200);
        }

        return $this->ApiPaginationResponse(ClubResource::collection($clubs), 'success', 200);
    }

    public function show(string $id): JsonResponse
    {
        $club = $this->clubs->query()
            ->with(['images', 'address', 'offers', 'reviews.user', 'schedules.activity'])
            ->withAvg('reviews', 'rating')
            ->find($id);

        if (!$club) {
            return $this->notFoundResponse();
        }

        return $this->apiResponse(new ClubDetailsResource($club), 'success', 200);
    }

    public function searchOnMap(Request $request): JsonResponse
    {
        $clubs = $this->clubs->searchByAddress($request->input('search'));
        if ($clubs->isEmpty()) {
            return $this->apiResponse([], 'No clubs available', 200);
        }
        return $this->apiResponse(ClubResource::collection($clubs), 'success', 200);
    }

    
}
