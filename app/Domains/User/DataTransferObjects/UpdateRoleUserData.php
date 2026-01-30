<?php

namespace App\Domains\User\DataTransferObjects;

use App\Domains\Shared\Concerns\ValidationError;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class UpdateRoleUserData extends Data
{
    use ValidationError;

    public function __construct(
        #[Required, Exists('roles', 'id')]
        public int $role_id,
    )
    {
    }

    public static function attributes(): array
    {
        return [
            'role_id' => 'роль',
        ];
    }
}
