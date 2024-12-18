<?php

namespace App\related;

class Company
{
    public string $company;
    private Address $address;
    private array $team;
    private array $products;

    public function __construct(string $company, Address $address, array $team, array $products)
    {
        $this->company = $company;
        $this->address = $address;
        $this->team = $team;
        $this->products = $products;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return Company
     */
    public function setCompany(string $company): Company
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return Company
     */
    public function setAddress(Address $address): Company
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return array
     */
    public function getTeam(): array
    {
        return $this->team;
    }

    /**
     * @param array $team
     * @return Company
     */
    public function setTeam(array $team): Company
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     * @return Company
     */
    public function setProducts(array $products): Company
    {
        $this->products = $products;
        return $this;
    }

    public function addProduct(Product $product): Company
    {
        $this->products[] = $product;
        return $this;
    }

    public function addTeam(string $job, string $firstName, string $lastName): Company
    {
        $this->team[] = new User($job, $firstName, $lastName);
        return $this;
    }
}