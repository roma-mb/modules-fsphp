<?php

namespace app;

use app\traits\AddressTrait;
use app\traits\UserTrait;

class Register
{
    use UserTrait;
    use AddressTrait;

    public function __construct(User $user, Address $adrress)
    {
        $this->setUser($user);
        $this->setAddress($adrress);
        $this->save();
    }

    private function save(): void
    {
        $this->user->id = 123;
        $this->address->userId = $this->user->id;
    }
}