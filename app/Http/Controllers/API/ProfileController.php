<?php

namespace App\Http\Controllers\API;

use App\Helpers\AppHelper;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use App\Http\Resources\User\ProfileResource;
use App\Http\Requests\API\User\UploadImageRequest;
use App\Http\Requests\API\User\UpdateProfileRequest;
use App\Http\Requests\API\User\ChangePasswordRequest;

class ProfileController extends Controller
{
    use ApiResponseTrait;


    public function __construct(protected UserRepository $users) {}


    public function show(): JsonResponse
    {
        $user = auth()->user();
        return $this->ApiResponse(
            new ProfileResource($user),
            'Profile retrieved successfully',
            200
        );
    }


    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = AppHelper::uploadFiles('users', $request->file('image'));
        }

        // هنا نبعت $data بدل $user
        $updated = $this->users->update($data, $user->id);
        return $this->ApiResponse(
            new ProfileResource($updated),
            'Profile updated successfully',
            200
        );
    }




    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = Auth::user();
        $data = $request->validated();

        $this->users->update(['password' => $data['password']], $user->id);

        return $this->ApiResponse(null, 'Password changed successfully', 200);
    }

    public function updateImage(UploadImageRequest $request): JsonResponse
    {
        $user = Auth::user();
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = AppHelper::uploadFiles('users', $request->file('image'));
        }

        $this->users->update($data, $user->id);

        return $this->ApiResponse(null, 'Image updated successfully', 200);
    }
}
