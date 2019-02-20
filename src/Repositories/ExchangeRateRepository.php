<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

class ExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    /**
     * @var ConnectionInterface
     */
    private $db;
    /**
     * @var HydratorInterface
     */
    private $hydrator;
    /**
     * @var ExchangeRateRepositoryInterface
     */
    private $repository;

    /**
     * @param HydratorInterface $hydrator
     * @param ConnectionInterface $db
     */
    public function __construct(
        HydratorInterface $hydrator,
        ExchangeRateRepositoryInterface $repository,
        ReadExchangeRateRepositoryInterface $api
    ) {
        $this->hydrator = $hydrator;
        $this->repository = $repository;
        $this->api = $api;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        if (!$result = $this->repository->findAll()) {
            $response = $this->api->findAll();
            $this->repository->insert($response);
        }

        return $response;
    }

    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return ExchangeRate
     */
    public function findExchange(string $currencyFrom, string $currencyTo): ?ExchangeRate
    {
        if (!$result = $this->repository->findExchange($currencyFrom, $currencyTo)) {
            $response = $this->api->findExchange($currencyFrom, $currencyTo);
            $this->repository->insert([$response]);
        }

        return $response;
    }

    /**
     * Записываем данные в базу
     *
     * @param ExchangeRate[] $exchangeRates
     * @return bool
     */
    public function insert(array $exchangeRates): bool
    {
        return $this->repository->insert($exchangeRates);
    }

    /**
     * Может кто-то захочет очистить таблицу с курсами валют, чтобы заново выгрезить из апи
     * @return bool
     */
    public function clear(): bool
    {
        return $this->repository->clear();
    }
}
