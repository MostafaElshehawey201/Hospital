<?php

namespace App\Exceptions\Auth;

use Exception;
use Throwable;
use Override;

class InvalidException extends Exception
{
    public function __construct($code)
    {
        return parent::__construct(__('validation.login.invald'),$code);
    }
}
