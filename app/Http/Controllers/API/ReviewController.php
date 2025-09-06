<?php

namespace App\Http\Controllers\API;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ReviewRequest;
use App\Repositories\User\ReviewRepository;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected ReviewRepository $reviewRepository) {}

    public function store(ReviewRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $this->reviewRepository->store($data);
        return $this->apiResponse(null, 'Review created successfully', 201);
    }
}
