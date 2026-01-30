<?php

namespace App\Domains\User\Actions\Admin;

use App\Domains\Shared\Exceptions\ConflictHttpException;
use App\Domains\User\Models\User;

class UnbanUserAction
{
    public static function execute(User $user): User
    {
        if (!$user->is_banned) {
            throw new ConflictHttpException(409,'Пользователь не забанен!');
        }
        $user->update(['is_banned' => false]);


        return $user;
    }
}
