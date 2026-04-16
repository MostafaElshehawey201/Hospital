<?php

namespace App\Interfaces\Auth\Stratgy\Process;

interface LoginProcessStratgy
{
    public function support($dataDTO);

    public function login($dataDTO);
}
