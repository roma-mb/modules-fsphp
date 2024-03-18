<?php

namespace src;

use src\helpers\Trigger;

abstract class Account
{
    protected int $branch;
    protected int $account;
    protected User $client;
    protected float $balance;

    public function __construct($branch, $account, $client, $balance)
    {
        $this->branch = $branch;
        $this->account = $account;
        $this->client = $client;
        $this->balance = $balance;
    }

    public function extract(): string
    {
        $extract = $this->balance >= 1 ? Trigger::ACCEPT : Trigger::ERROR;
        return Trigger::show('|EXTRACT| Current balance: ' . $this->toUSD($this->balance), $extract);
    }

    public function toUSD(float $value): string
    {
        return '$:' . number_format($value, 2, '.', '');
    }

    abstract protected function deposit(float $value);
    abstract protected function withdrawal(float $value);
}