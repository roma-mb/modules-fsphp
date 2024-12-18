<?php

namespace src;

class User
{
    public string $job;
    public string $firstName;
    public string $lastName;

    /**
     * @param string $job
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName, string $job)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->job = $job;
    }

    public function getJob(): string
    {
        return $this->job;
    }

    public function setJob(string $job): void
    {
        $this->job = $job;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }


}