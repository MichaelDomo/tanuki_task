<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

interface ReadExchangeRateRepositoryInterface
{
    /**
     * @return ExchangeRate[]
     */
    public function findAll(): array;
    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return ExchangeRate|null
     */
    public function findExchange(string $currencyFrom, string $currencyTo): ?ExchangeRate;
}
