<?php

namespace App\Domains\User\Actions\Admin;

use App\Domains\Shared\Model\Role;
use App\Domains\User\DataTransferObjects\CreateRoleUserData;

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
