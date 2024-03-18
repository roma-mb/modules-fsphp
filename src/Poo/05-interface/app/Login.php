<?php

namespace app;

class Login
{
    public UserInterface $user;

    public function connection(UserInterface $user): UserInterface
    {
        $this->user = $user;
        return $this->user;
    }
}