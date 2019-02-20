<?php

namespace src\Entities;

class ExchangeRate
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $currencyFrom;
    /**
     * @var string
     */
    private $currencyTo;
    /**
     * @var float
     */
    private $rate;

    /**
     * @param string $id Можно сделать составной первичный ключ
     * @param string $currencyFrom
     * @param string $currencyTo
     * @param float $rate
     */
    public function __construct(int $id, string $currencyFrom, string $currencyTo, float $rate)
    {
        $this->id = $id;
        $this->currencyFrom = $currencyFrom;
        $this->currencyTo = $currencyTo;
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getCurrencyFrom(): string
    {
        return $this->currencyFrom;
    }

    /**
     * @return string
     */
    public function getCurrencyTo(): string
    {
        return $this->currencyTo;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
