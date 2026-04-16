<?php

namespace App\Stratgies\Auth\Process;

use App\Interfaces\Auth\Stratgy\Process\LoginProcessStratgy;
use App\Models\User;

class PhoneLoginStratgy implements LoginProcessStratgy
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function support($loginDTO){
        return preg_match('/^01(0|1|2|5)[0-9]{8}$/' , $loginDTO->login);
    }

    public function login($loginDTO){
        return User::where('phone' , $loginDTO->login)->first();
    }
}
