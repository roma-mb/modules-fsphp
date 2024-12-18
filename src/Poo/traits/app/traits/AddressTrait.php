<?php

namespace app\traits;

use app\Address;

trait AddressTrait
{
    private Address $address;

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): static
    {
        $this->address = $address;
        return $this;
    }
}