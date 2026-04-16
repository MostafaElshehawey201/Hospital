<?php

namespace App\Http\Controllers\Auth;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegisterDTO;
use App\Exceptions\Auth\LoginNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\Auth\LoginServiceInterface;
use App\Interfaces\Auth\RegisterServiceInterface;
use App\Trait\Auth\Response;

class AuthController extends Controller
{
    use Response;

    public function __construct(
        protected RegisterServiceInterface $register_service_interface,
        protected LoginServiceInterface $login_service_interface
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
}
