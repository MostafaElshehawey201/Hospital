<?php

namespace App\Exceptions\Auth;

use Exception;


class LoginNotFoundException extends Exception
{
    public function __construct($code)
    {
        return parent::__construct(__('validation.login.notFound'), $code);
    }
}
