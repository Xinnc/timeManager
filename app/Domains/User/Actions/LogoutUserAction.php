<?php

namespace App\Domains\User\Actions;

use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutUserAction
{
    public static function execute(): void
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        auth()->logout();
    }
}
