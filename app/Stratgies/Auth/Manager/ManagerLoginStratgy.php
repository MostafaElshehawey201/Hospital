<?php

namespace App\Stratgies\Auth\Manager;

use App\Exceptions\Auth\LoginNotFoundException;
use App\Interfaces\Auth\Stratgy\Manager\ManagerLoginStratgyInterface;
use App\Stratgies\Auth\Process\EmailLoginStratgy;
use App\Stratgies\Auth\Process\PhoneLoginStratgy;

class ManagerLoginStratgy implements ManagerLoginStratgyInterface
{
    /**
     * Create a new class instance.
     */
    public $stratgies;
    public function __construct(protected EmailLoginStratgy $email_login_stratgy, protected PhoneLoginStratgy $phone_login_stratgy)
    {
        $this->stratgies = [
            $email_login_stratgy,
            $phone_login_stratgy,
        ];
    }

    public function login($loginDTO)
    {
        foreach ($this->stratgies as $strategy) {
            if ($strategy->support($loginDTO)) {
                return $strategy->login($loginDTO);
            }
        }
    }
}
