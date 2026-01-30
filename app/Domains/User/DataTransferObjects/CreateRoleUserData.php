<?php

namespace App\Domains\User\DataTransferObjects;

use App\Domains\Shared\Concerns\ValidationError;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class CreateRoleUserData extends Data
{
    use ValidationError;

    public function __construct(
        #[Required, Unique('roles', 'role')]
        public string $role,
    )
    {
    }

    public static function attributes(): array
    {
        return [
            'role' => 'роль',
        ];
    }

    public static function messages(): array
    {
        return [
            'role.unique' => "Данная роль уже существует"
        ];
    }
}
