<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

class CacheExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    /**
     * @var ConnectionInterface
     */
    private $cache;
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @param HydratorInterface $hydrator
     * @param CacheInterface $cache
     */
    public function __construct(HydratorInterface $hydrator, CacheInterface $cache)
    {
        $this->cache = $cache;
        $this->hydrator = $hydrator;
    }

    /**
     * @param array $conditions
     * @return string
     */
    public function key(array $conditions = []): string
    {
        return 'exchange-' . md5(serialize($conditions));
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        $result = $this->cache->get($this->key());

        return $this->hydrator->hydrate(ExchangeRate::class, $result);
    }

    /**
     * @inheritdoc
     */
    public function findExchange(string $currencyFrom, string $currencyTo): ExchangeRate
    {
        $result = $this->cache->get($this->key(['currency_from' => $currencyFrom, 'currency_to' => $currencyTo]));

        return $this->hydrator->hydrate(ExchangeRate::class, $result);
    }
}
