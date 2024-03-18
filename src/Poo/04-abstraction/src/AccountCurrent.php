<?php

namespace src;

use src\helpers\Trigger;

class AccountCurrent extends Account
{
    private float $interest = 0.006;
    private float $limit = 500.00;
    private float $tax = 0.006;

    final public function deposit(float $value): string
    {
        $this->balance += $value;

        return Trigger::show(
            '|DEPOSIT| Successful deposit of ' . $this->toUSD($value),
            Trigger::ACCEPT
        );
    }

    final public function withdrawal(float $value): string
    {
        $absolutValue = abs($value);

        $taxValue = ($this->balance < $absolutValue)
            ? abs($this->balance - $absolutValue) * $this->tax
            : 0.0;

        $valueWithTax = ($absolutValue + $taxValue);
        $valueToWithdrawal = ($this->balance + $this->limit) - $valueWithTax;

        if ($valueToWithdrawal < 0) {
            return Trigger::show(
                '|WITHDRAWAL| Insufficient balance, actual with limit: ' . $this->toUSD($this->balance),
                Trigger::ERROR
            );
        }

        $this->balance = $valueToWithdrawal;

        $message = '|WITHDRAWAL| Withdrawal of  ' . $this->toUSD($valueWithTax);
        $message .= ' Used limit rate: ' . $this->toUSD($taxValue);
        $error = Trigger::ERROR;

        return Trigger::show($message, $error);
    }

    public function setLimit(float $limit): static
    {
        $this->limit = $limit;

        return $this;
    }
}