<?php

namespace App\Http\Controllers\API\Provider\Club;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Provider\Club\ClubService;
use App\Http\Requests\API\Provider\Club\StoreClubRequest;

class ClubController extends Controller
{
    public function __construct(protected ClubService $clubService) {}

    public function store(StoreClubRequest $request): JsonResponse
    {

        return $this->clubService->store($request->validated());
    }
}
