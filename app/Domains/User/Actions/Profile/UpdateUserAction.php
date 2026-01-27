<?php

namespace App\Domains\User\Actions\Profile;

use App\Domains\User\DataTransferObjects\UpdateUserData;
use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{
    public static function execute(UpdateUserData $data): User
    {
        /** @var User $user */
        $user = auth()->user();
        $fields = $data->getFilledFields();

        if(isset($fields["password"])){
            $fields["password"] = Hash::make($fields["password"]);
        }
        if(!empty($fields)){
            $user->update($fields);
        }

        return $user;
    }
}
