<?php

namespace App\Domains\User\Actions\Profile;

use App\Domains\Shared\Exceptions\ValidationFailedException;
use App\Domains\User\DataTransferObjects\UpdatePasswordUserData;
use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordUserAction
{
    public static function execute(UpdatePasswordUserData $data): User
    {
        /** @var User $user */
        $user = auth()->user();


        if (!Hash::check($data->old_password, $user->password)) {
            throw new ValidationFailedException(422, "Неверный старый пароль!");
        }

        if (Hash::check($data->password, $user->password)) {
            throw new ValidationFailedException(422, "Данный пароль уже установлен!");
        }

        $user->password = Hash::make($data->password);

        return $user;
    }
}
