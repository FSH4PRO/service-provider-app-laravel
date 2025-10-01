<?php

namespace App\Http\Controllers\provider;

use App\Enums\RoleUserEnum;
use App\Http\Controllers\Controller;
use App\Services\Global\AuthService;
use App\Http\Requests\Global\LoginRequest;
use App\Http\Requests\Global\RegisterRequest;
use App\Http\Resources\Global\ProfileResource;

class AuthController extends Controller
{
     protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $attr = $request->validated();
        $user =  $this->authService->register($attr, RoleUserEnum::PROVIDER);
        return $this->success(new ProfileResource($user), 'User registered successfully');
    }

    public function login(LoginRequest $request)
    {
        $attr = $request->validated();
        $user = $this->authService->login($attr, RoleUserEnum::PROVIDER);
        return $this->success(new ProfileResource($user), 'User logged in successfully');
    }

    public function profile()
    {
        $user = $this->authService->profile();
        return $this->success(new ProfileResource($user));
    }
}
