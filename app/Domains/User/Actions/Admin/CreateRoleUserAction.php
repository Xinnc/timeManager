<?php

namespace App\Domains\User\Actions\Admin;

use App\Domains\Shared\Exceptions\ForbiddenForYouException;
use App\Domains\Shared\Model\Role;
use App\Domains\User\DataTransferObjects\CreateRoleUserData;
use App\Domains\User\DataTransferObjects\UpdateRoleUserData;
use App\Domains\User\Models\User;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class CreateRoleUserAction
{
    public static function execute(CreateRoleUserData $data): Role
    {
        $role = Role::create([
            'role' => $data->role,
        ]);

        return $role;
    }
}
