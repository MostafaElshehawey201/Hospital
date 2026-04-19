<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\InvalidException;
use App\Interfaces\Auth\LoginServiceInterface;
use App\Interfaces\Auth\RegisterRepositoryInterface;
use App\Interfaces\Auth\RegisterServiceInterface;
use App\Interfaces\Auth\RequestOtpInterface;
use App\Interfaces\Auth\Stratgy\Manager\ManagerLoginStratgyInterface;
use App\Interfaces\Auth\Stratgy\Manager\ManagerRequestOtpStratgyInterface;

class AuthServices implements RegisterServiceInterface , LoginServiceInterface , RequestOtpInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected RegisterRepositoryInterface $register_repository_interface ,
     protected ManagerLoginStratgyInterface $manager_login_stratgy_interface ,
     protected ManagerRequestOtpStratgyInterface $manager_request_otp_stratgy_interface)
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

    public function request_otp($RequetOtpDTO){
        $user = $this->manager_request_otp_stratgy_interface->ManagerRequestOtp($RequetOtpDTO);
        if(!$user){
            throw new InvalidException(422);
        }
        return $this->manager_request_otp_stratgy_interface->request_otp($user);
    }
}
