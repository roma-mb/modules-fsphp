<?php

namespace app;

use app\UserAdminInterface;

class UserAdmin extends User implements UserAdminInterface
{
    protected int $level = 10;
    protected string $error = '';

    public function getError(): string
    {
        return $this->error;
    }

    public function setError($error): static
    {
        $this->error = $error;

        return $this;
    }
}