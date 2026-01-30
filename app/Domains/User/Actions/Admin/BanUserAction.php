<?php

namespace App\Domains\User\Actions\Admin;

use App\Domains\Shared\Exceptions\ConflictHttpException;
use App\Domains\User\Models\User;

class BanUserAction
{
    public static function execute(User $user): User
    {
        if ($user->id === auth()->id()) {
            throw new ConflictHttpException(409, 'Вы не можете забанить самого себя!');
        }

        if ($user->is_banned) {
            throw new ConflictHttpException(409, 'Пользователь уже забанен!');
        }

        $user->update(['is_banned' => true]);

        return $user;
    }
}
