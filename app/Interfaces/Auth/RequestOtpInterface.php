<?php

namespace App\Interfaces\Auth;

interface RequestOtpInterface
{
    public function request_otp($RequetOtpDTO);
}
