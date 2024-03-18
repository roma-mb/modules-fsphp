<?php

namespace src;

use src\helpers\Trigger;

class AccountSaving extends Account
{
    private float $interest = 0.006;

    public function deposit(float $value): string
    {
        $this->balance += $value + ($value * $this->interest);

        return Trigger::show(
            '|DEPOSIT| Successful deposit of ' . $this->toUSD($value),
            Trigger::ACCEPT
        );
    }

    public function withdrawal(float $value): string
    {
        $message = '|WITHDRAWAL| Insufficient balance, actual: ' . $this->toUSD($this->balance);
        $error = Trigger::ERROR;

        if ($this->balance >= $value) {
            $this->balance -= abs($value);

           $message = '|WITHDRAWAL| Withdrawal of ' . $this->toUSD($value);
           $error =  Trigger::WARNING;
        }

        return Trigger::show($message, $error);
    }
}