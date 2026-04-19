<?php

namespace App\Interfaces\Auth\Stratgy\Process;

interface RequestOtpInterfaceStratgy
{
    public function support($RequetOtpDTO);

    public function user($RequetOtpDTO);

    public function request_otp($user);
}
