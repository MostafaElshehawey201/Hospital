<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\InvalidException;
use App\Interfaces\Auth\LoginServiceInterface;
use App\Interfaces\Auth\RegisterRepositoryInterface;
use App\Interfaces\Auth\RegisterServiceInterface;
use App\Interfaces\Auth\Stratgy\Manager\ManagerLoginStratgyInterface;

class AuthServices implements RegisterServiceInterface , LoginServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected RegisterRepositoryInterface $register_repository_interface , protected ManagerLoginStratgyInterface $manager_login_stratgy_interface)
    {
        //
    }

    public function register($dataDTO){
        return $this->register_repository_interface->register($dataDTO);
    }

    public function login($dataDTO){
        $user = $this->manager_login_stratgy_interface->login($dataDTO);
        if(!$user){
            throw new InvalidException(422);
        }
        $token = $user->createToken('auth-token')->plainTextToken;
        return [$token , $user];
    }
}
