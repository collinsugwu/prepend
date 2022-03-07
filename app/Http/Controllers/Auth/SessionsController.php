<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\UserService;

class SessionsController extends Controller
{
    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $request
     * @return array
     */
    public function login(LoginRequest $request): array
    {
        # verify login params and create token.
        list($user, $token) = $this->userService->login($request);

        return [
            'user' => new LoginResource($user),
            'token' => $token,
        ];
    }
}
