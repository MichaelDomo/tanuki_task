<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

interface ExchangeRateRepositoryInterface extends ReadExchangeRateRepositoryInterface
{
    /**
     * @param array $exchangeRates
     * @return bool
     */
    public function insert(array $exchangeRates): bool;
    /**
     * @return bool
     */
    public function clear(): bool;
}
