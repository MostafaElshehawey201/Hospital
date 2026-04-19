<?php

namespace App\Stratgies\Auth\Process;

use App\Interfaces\Auth\Stratgy\Process\RequestOtpInterfaceStratgy;
use App\Models\Otp;
use App\Models\User;

class PhoneRequestOtpStratgy implements RequestOtpInterfaceStratgy
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function support($RequetOtpDTO) {
        return preg_match('/^01(0|1|2|5)[0-9]{8}$/' , $RequetOtpDTO->login);
    }

    public function user($RequetOtpDTO) {
        return User::where('phone' , $RequetOtpDTO->login)->first();
    }

    public function request_otp($user){
        $otp=  random_int(100000 , 999999);
        Otp::create([
            "user_id" => $user->id,
            "used" => 0,
            "expires_at" => now()->addMinutes(2),
            "otp" => $otp,
        ]);
    }
}
