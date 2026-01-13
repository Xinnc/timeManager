<?php

namespace App\Domains\User\Exceptions;

use App\Domains\Shared\Exceptions\ApiException;

class FailedLoginException extends ApiException
{
    public function __construct($code = 401, $message = 'Ошибка авторизации. Проверьте почту и пароль.'){
        parent::__construct($code, $message);
    }
}
