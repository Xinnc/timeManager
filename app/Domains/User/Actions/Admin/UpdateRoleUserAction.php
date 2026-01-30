<?php

namespace App\Domains\User\Actions\Admin;

use App\Domains\Shared\Exceptions\ForbiddenForYouException;
use App\Domains\Shared\Model\Role;
use App\Domains\User\DataTransferObjects\UpdateRoleUserData;
use App\Domains\User\Models\User;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UpdateRoleUserAction
{
    public static function execute(UpdateRoleUserData $data, User $user): User
    {
        if($user->role_id == 1){
            throw new ForbiddenForYouException(403, 'Вы не можете изменить роль админа!');
        }
        $user->update([
            'role_id' => $data->role_id
        ]);
        return $user;
    }
}
