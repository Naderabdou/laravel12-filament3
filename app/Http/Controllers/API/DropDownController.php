<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\GeneralResource;

class DropDownController extends Controller
{
    public function index(string $model, Request $request): JsonResponse
    {
        $data = match ($model) {

            'categories' => Category::query()->get(),

            default => [],
        };
        return response()->json([
            'data' => GeneralResource::collection($data),
        ]);
    }
}
