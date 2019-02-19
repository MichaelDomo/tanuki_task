<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

interface ExchangeRateRepositoryInterface
{
    /**
     * @return ExchangeRate[]
     */
    public function findAll(): array;
    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return ExchangeRate
     */
    public function findExchange(string $currencyFrom, string $currencyTo): ExchangeRate;
}
