<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserService
{
    /**
     * @param Request $request
     * @return array
     */
    public function login(Request $request): array
    {
        # validate email
        $user = User::whereEmail($request->email)->first();
        abort_unless(is_object($user),
            ResponseAlias::HTTP_UNAUTHORIZED, 'Email does not exist');

        # Verify the password
        $verify = Hash::check($request->password, $user->password);
        abort_unless($verify,
            ResponseAlias::HTTP_UNAUTHORIZED, 'Wrong Password');

        # check if a valid token exist else create a new token
        $token = $user->currentAccessToken();
        if (is_null($token)) {
            $token = $user->createToken('loginToken')->plainTextToken;
        }
        return [
            $user, $token
        ];
    }
}
