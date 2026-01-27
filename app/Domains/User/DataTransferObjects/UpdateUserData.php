<?php

namespace App\Domains\User\DataTransferObjects;

use App\Domains\Shared\Concerns\ValidationError;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class UpdateUserData extends Data
{
    use ValidationError;

    public function __construct(
        #[Nullable, StringType, Min(2)]
        public ?string $first_name,

        #[Nullable, StringType, Min(2)]
        public ?string $surname,

        #[Nullable, StringType, Min(2)]
        public ?string $last_name,

        #[Nullable, Email, Unique('users', 'email')]
        public ?string $email,

        #[Nullable, StringType, Min(8)]
        public ?string $password,
    ) {}

    public static function attributes(): array
    {
        return [
            'first_name' => 'имя',
            'surname'    => 'фамилия',
            'last_name'  => 'отчество',
            'email'      => 'email',
            'password'   => 'пароль',
        ];
    }

    public function getFilledFields(): array
    {
        $filled = [];

        if($this->first_name !== null) {
            $filled['first_name'] = $this->first_name;
        }
        if ($this->surname !== null) {
            $filled['surname'] = $this->surname;
        }
        if($this->last_name !== null) {
            $filled['last_name'] = $this->last_name;
        }
        if ($this->email !== null) {
            $filled['email'] = $this->email;
        }
        if ($this->password !== null) {
            $filled['password'] = $this->password;
        }
        return $filled;
    }
}
