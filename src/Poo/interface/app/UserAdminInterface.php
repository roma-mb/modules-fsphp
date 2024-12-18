<?php

namespace app;

interface UserAdminInterface
{
    public function getError(): string;
    public function setError(string $error): static;
}