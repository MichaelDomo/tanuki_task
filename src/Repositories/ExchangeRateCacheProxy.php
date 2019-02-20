<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

class ExchangeRateCacheProxy implements ExchangeRateRepositoryInterface
{
    /**
     * Время жизни кеша
     *
     * @var int
     */
    public const CACHE_DURATION = 3600;

    /**
     * @var ExchangeRateRepositoryInterface
     */
    private $repository;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @param ExchangeRateRepositoryInterface $repository
     * @param CacheInterface $cache
     */
    public function __construct(
        ExchangeRateRepositoryInterface $repository,
        CacheInterface $cache
    )
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    /**
     * @param array $conditions
     * @return string
     */
    private function cacheKey(array $conditions = []): string
    {
        $key = 'exchange';

        return empty($conditions) ? $key : ($key .= '-' . md5(serialize($conditions)));
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $key = $this->cacheKey();
        $result = $this->cache->get($key);
        if (!empty($result)) {
            return $result;
        }

        $result = $this->repository->findAll();
        if (!empty($result)) {
            $this->cache->set($key, $result, self::CACHE_DURATION);

            return $result;
        }

        return [];
    }

    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return null|ExchangeRate
     */
    public function findExchange(string $currencyFrom, string $currencyTo): ?ExchangeRate
    {
        $key = $this->cacheKey(['currency_from' => $currencyFrom, 'currency_to' => $currencyTo]);
        $result = $this->cache->get($key);
        if (!empty($result)) {
            return $result;
        }

        $result = $this->repository->findExchange($currencyFrom, $currencyTo);
        if (!empty($result)) {
            $this->cache->set($key, $result, self::CACHE_DURATION);

            return $result;
        }

        return null;
    }

    /**
     * @param array|ExchangeRate[] $exchangeRates
     * @return bool
     */
    public function insert(array $exchangeRates): bool
    {
        if (count($exchangeRates) === 1) {
            /** @var ExchangeRate $headRate */
            $headRate = $exchangeRates[0];
            $key = $this->cacheKey(['currency_from' => $headRate->getCurrencyFrom(), 'currency_to' => $headRate->getCurrencyTo()]);
        } else {
            $key = $this->cacheKey();
        }

        $this->cache->set($key, $result, self::CACHE_DURATION);

        return $this->repository->insert($exchangeRates);
    }

    /**
     * @return bool
     */
    public function clear(): bool
    {
        $keys = $this->cache->keys('prefix:' . $this->cacheKey());
        foreach ($keys as $key) {
            $this->cache->delete($key);
        }

        return $this->repository->clear();
    }
}
