<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\AuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Resources\User\LoginResource;
use App\Http\Resources\User\RegistrationResource;
use App\Structures\Users\LoginDTO;
use App\Structures\Users\RegistrationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function __construct(
        private AuthServiceInterface $service
    )
    {}

    public function register(RegistrationRequest $request): JsonResource
    {
        $data = RegistrationDTO::from($request->validated());

        return $this->service
            ->register($data)
            ->toResource(RegistrationResource::class);
    }

    public function login(LoginRequest $request): JsonResource
    {
        $data = LoginDTO::from($request->validated());
        $user = $this->service->login($data);

        return $user['user']->toResource(LoginResource::class)
            ->additional(['token' => $user['token']]);
    }

    public function logout(): JsonResponse
    {
        $this->service->logout();

        return response()->json([
            'message' => __('user.login.logout')
        ]);
    }

    public function spaLogin(LoginRequest $request): JsonResource
    {
        $data = LoginDTO::from($request->validated());
        $user = $this->service->spaLogin($data);

        return $user->toResource(LoginResource::class);
    }

    public function spaLogout(): JsonResponse
    {
        $this->service->spaLogout();

        return response()->json([
            'message' => __('user.login.logout')
        ]);
    }
}
