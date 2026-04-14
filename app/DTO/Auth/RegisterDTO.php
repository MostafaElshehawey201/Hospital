<?php

namespace App\DTO\Auth;

class RegisterDTO{
    public $name;
    public $email;
    public $phone;
    public $password;

    public function __construct($validation)
    {
        $this->name = $validation['name'];
        $this->email = $validation['email'];
        $this->phone = $validation['phone'];
        $this->password = $validation['password'];
    }
}
