<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\RegisterRepositoryInterface;
use App\Interfaces\Auth\RegisterServiceInterface;

class AuthServices implements RegisterServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected RegisterRepositoryInterface $register_repository_interface)
    {
        //
    }

    public function register($dataDTO){
        return $this->register_repository_interface->register($dataDTO);
    }
}
