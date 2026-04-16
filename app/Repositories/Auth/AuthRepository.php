<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\RegisterRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements RegisterRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function register($dataDTO)
    {
        return User::create([
            "name" => $dataDTO->name,
            "email" => $dataDTO->email,
            "phone" => $dataDTO->phone,
            "password" => Hash::make($dataDTO->password),
        ]);
    }
}
