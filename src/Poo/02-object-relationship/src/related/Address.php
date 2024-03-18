<?php

namespace App\related;

class Address
{
    public string $street;
    public int $number;
    public string $complement;

    /**
     * @param string $street
     * @param int $number
     * @param string $complement
     */
    public function __construct(string $street, int $number, string $complement)
    {
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): Address
    {
        $this->number = $number;
        return $this;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): Address
    {
        $this->complement = $complement;
        return $this;
    }
}
