<?php

namespace App\Http\Controllers\API\Provider\Package;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\Provider\Package\PackageRepository;
use App\Http\Resources\Provider\Package\PackageResource;

class PackageController extends Controller
{
    use ApiResponseTrait;
    public function __construct(protected PackageRepository $packages){}

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 10);
        $packages = $this->packages->query()->paginate($perPage);
        return $this->ApiPaginationResponse(PackageResource::collection($packages), 'success', 200);
    }

}