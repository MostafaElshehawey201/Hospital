<?php

namespace App\DTO\Auth;

class LoginDTO{
    public $login;
    public $password;

    public function __construct($validation)
    {
        $this->login = $validation['login'];
        $this->password = $validation['password'];
    }
}
