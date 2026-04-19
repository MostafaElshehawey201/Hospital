<?php

namespace App\Stratgies\Auth\Manager;

use App\Interfaces\Auth\Stratgy\Manager\ManagerRequestOtpStratgyInterface;
use App\Models\Otp;
use App\Stratgies\Auth\Process\EmailRequestOtpStratgy;
use App\Stratgies\Auth\Process\PhoneRequestOtpStratgy;

class ManagerRequestOtpStratgy implements ManagerRequestOtpStratgyInterface
{
    /**
     * Create a new class instance.
     */
    public $stratgies;

    public function __construct(protected EmailRequestOtpStratgy $email_request_otp_stratgy, protected PhoneRequestOtpStratgy $phone_request_otp_stratgy)
    {
        $this->stratgies = [
            $email_request_otp_stratgy,
            $phone_request_otp_stratgy,
        ];
    }

    public function ManagerRequestOtp($RequetOtpDTO)
    {
        foreach ($this->stratgies as $strategy) {
            if ($strategy->support($RequetOtpDTO)) {
                return $strategy->user($RequetOtpDTO);
            };
        }
    }

    public function request_otp($user)
    {
        $otp = random_int(100000, 999999);
        Otp::create([
            "otp" => $otp,
            "expires_at" => now()->addMinutes(2),
            "user_id" => $user->id,
            "used" => 0
        ]);
        return $otp;
    }
}
