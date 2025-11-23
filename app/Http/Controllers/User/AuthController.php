<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\AuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Resources\User\RegistrationResource;
use App\Structures\Users\RegistrationDTO;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function __construct(
        private AuthServiceInterface $service
    )
    {

    }

    public function register(RegistrationRequest $request): JsonResource
    {
        $validated = $request->validated();
        $dto = RegistrationDTO::from($validated);

        return $this->service->register($dto)->toResource(RegistrationResource::class);
    }
}
