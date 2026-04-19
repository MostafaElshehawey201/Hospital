<?php

namespace App\Http\Controllers\Auth;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegisterDTO;
use App\DTO\Auth\RequestOtp;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\RequestOtpRequest;
use App\Interfaces\Auth\LoginServiceInterface;
use App\Interfaces\Auth\RegisterServiceInterface;
use App\Interfaces\Auth\RequestOtpInterface;
use App\Trait\Auth\Response;

class AuthController extends Controller
{
    use Response;

    public function __construct(
        protected RegisterServiceInterface $register_service_interface,
        protected LoginServiceInterface $login_service_interface,
        protected RequestOtpInterface $request_otp_interface
    ) {}
    public function register(RegisterRequest $registerRequest)
    {
        try {
            $validation = $registerRequest->validated();
            $dataDTO = new RegisterDTO($validation);
            $user = $this->register_service_interface->register($dataDTO);
            return $this->success($user, 201);
        } catch (\Exception $e) {
            return $this->errors($e->getMessage(), 422);
        }
    }

    public function login(LoginRequest $loginRequest)
    {
        try {
            $validation = $loginRequest->validated();
            $dataDTO = new LoginDTO($validation);
            $token = $this->login_service_interface->login($dataDTO);
            return $this->success($token, 200);
        } catch (\Exception $e) {
            return $this->errors($e->getMessage(), $e->getCode());
        }
    }

    public function request_otp(RequestOtpRequest $requestOtpRequest)
    {
        try {
            $validation = $requestOtpRequest->validated();
            $RequetOtpDTO = new RequestOtp($validation);
            $otp = $this->request_otp_interface->request_otp($RequetOtpDTO);
            return $this->success($otp, 200);
        } catch (\Exception $e) {
            return $this->errors($e->getMessage(), 500);
        }
    }
}
