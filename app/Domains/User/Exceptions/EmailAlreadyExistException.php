<?php

namespace App\Domains\User\Exceptions;

use App\Domains\Shared\Exceptions\ApiException;

class EmailAlreadyExistException extends ApiException
{
    public function __construct($code = 409, $message = 'Пользователь с такой почтой уже существует.'){
        parent::__construct($code, $message);
    }
}
