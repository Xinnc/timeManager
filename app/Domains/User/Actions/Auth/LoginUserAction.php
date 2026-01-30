<?php

namespace App\Domains\User\Actions\Auth;

use App\Domains\User\DataTransferObjects\LoginUserData;
use App\Domains\User\Exceptions\FailedLoginException;
use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginUserAction
{
    public static function execute(LoginUserData $data): string
    {
        $user = User::where('email', $data->email)->first();
        if (!$user || !Auth::attempt([
                'email' => $data->email,
                'password' => $data->password
            ])) throw new FailedLoginException();
        $token = JWTAuth::fromUser($user);
        return $token;
    }
}
