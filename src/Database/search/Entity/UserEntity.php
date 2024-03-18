<?php

namespace src\Database\search\Entity;

class UserEntity
{
    private int $id = 0;
    private string $first_name = '';
    private string $last_name = '';
    private string $email = '';
    private string $document = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDocument(): string
    {
        return $this->document;
    }


}