<?php

namespace src\Entities;

class ExchangeRate
{
    private $currencyFrom;
    private $currencyTo;
    private $rate;

    public function __construct(string $currencyFrom, string $currencyTo, float $rate)
    {
        $this->currencyFrom = $currencyFrom;
        $this->currencyTo = $currencyTo;
        $this->rate = $rate;
    }

    public function getCurrencyFrom(): string
    {
        return $this->currencyFrom;
    }

    public function getCurrencyTo(): string
    {
        return $this->currencyTo;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}
