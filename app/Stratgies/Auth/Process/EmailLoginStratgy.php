<?php

namespace App\Stratgies\Auth\Process;

use App\Interfaces\Auth\Stratgy\Process\LoginProcessStratgy;
use App\Models\User;

class EmailLoginStratgy implements LoginProcessStratgy
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function support($loginDTO){
        return (bool) filter_var($loginDTO->login , FILTER_VALIDATE_EMAIL);
    }

    public function login($loginDTO){
        return User::where('email' , $loginDTO->login)->first();
    }
}
