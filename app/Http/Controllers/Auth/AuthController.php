<?php

namespace App\Http\Controllers\Auth;

use App\DTO\Auth\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\Auth\RegisterServiceInterface;
use App\Trait\Auth\Response;

class AuthController extends Controller
{
    use Response;

    public function __construct(protected RegisterServiceInterface $register_service_interface) {}
    public function register(RegisterRequest $registerRequest)
    {
        try {
            $validation = $registerRequest->validated();
            $dataDTO = new RegisterDTO($validation);
            $user = $this->register_service_interface->register($dataDTO);
            return $this->success($user, 200);
        } catch (\Exception $e) {
            return $this->errors($e->getMessage(), 422);
        }
    }
}
