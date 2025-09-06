<?php

namespace App\Http\Controllers\API\Auth;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\AuthResource;
use App\Repositories\Auth\AuthRepository;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\SocialRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Requests\API\Auth\CheckCodeRequest;
use App\Http\Requests\API\Auth\ResetPasswordRequest;
use App\Http\Requests\API\Auth\ForgetPasswordRequest;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AuthRepository $authRepository) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->authRepository->login($request->validated());

        if (!$user) {
            return $this->ApiResponse(null, __('Invalid email or password'), 401);
        }

        return $this->ApiResponse(new AuthResource($user), __('Login successfully'), 200);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authRepository->register($request->validated());

        return $this->ApiResponse(new AuthResource($user), __('Registration successful'), 201);
    }

    public function forgetPassword(ForgetPasswordRequest $request): JsonResponse
    {
        $this->authRepository->forgetPassword($request->validated());

        return $this->ApiResponse(null, __('Code sent successfully'), 200);
    }
    public function resendCode(ForgetPasswordRequest $request): JsonResponse
    {
        $this->authRepository->resendCode($request->validated());

        return $this->ApiResponse(null, __('Code sent successfully'), 200);
    }

    public function checkCode(CheckCodeRequest $request): JsonResponse
    {
        $isValid = $this->authRepository->checkCode($request->validated());

        if (!$isValid) {
            return $this->ApiResponse(null, __('Invalid code'), 400);
        }

        return $this->ApiResponse($isValid->token, __('Code is correct'), 200);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $user = $this->authRepository->resetPassword($request->validated());

        if (!$user) {
            return $this->ApiResponse(null, __('Failed to reset password'), 400);
        }

        return $this->ApiResponse(null, __('Password reset successfully'), 200);
    }

    //handleSocialLogin
    public function handleSocialLogin(SocialRequest $request): JsonResponse
    {

        $result = $this->authRepository->handleSocialLogin($request->validated());

        if (!$result) {
            return $this->ApiResponse([], __('Login failed'), 422);
        }
        return $this->ApiResponse(new AuthResource($result), __('Login successfully'), 200);
    }

    public function logout(): JsonResponse
    {
        $this->authRepository->logout(auth()->user());

        return $this->ApiResponse(null, __('Logout successfully'), 200);
    }
}