<?php

namespace App\Domains\User\DataTransferObjects;

use App\Domains\Shared\Concerns\ValidationError;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class UpdatePasswordUserData extends Data
{
    use ValidationError;

    public function __construct(
        #[Required, StringType, Min(8)]
        public string $password,

        #[Required, StringType]
        public string $old_password,
    )
    {
    }

    public static function attributes(): array
    {
        return [
            'password' => 'новый пароль',
            'old_password' => 'старый пароль'
        ];
    }
}
