<?php

namespace App\DTO\Auth;

class RequestOtp{
    public $login;

    public function __construct($validation)
    {
        $this->login = $validation['login'];
    }
}
