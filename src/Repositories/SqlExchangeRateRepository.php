<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

class SqlExchangeRateRepository implements ExchangeRateRepositoryInterface
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
     * @param HydratorInterface $hydrator
     * @param ConnectionInterface $db
     */
    public function __construct(HydratorInterface $hydrator, ConnectionInterface $db)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
    }

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'exchange_rate';
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        $result = $this->db->queryAll($this->tableName());

        return $this->hydrator->hydrate(ExchangeRate::class, $result);
    }

    /**
     * @inheritdoc
     */
    public function findExchange(string $currencyFrom, string $currencyTo): ExchangeRate
    {
        $result = $this->db->queryOne(
            $this->tableName(),
            ['currency_from' => $currencyFrom, 'currency_to' => $currencyTo]
        );

        return $this->hydrator->hydrate(ExchangeRate::class, $result);
    }

    /**
     * Записываем данные в базу
     *
     * @param ExchangeRate[] $exchangeRates
     * @return bool
     */
    public function insert(array $exchangeRates): bool
    {
        $columns = ['currency_from', 'currency_to', 'rate'];

        return $this->db->batchInsert(
            $this->tableName(),
            $columns,
            array_map(function (ExchangeRate $exchangeRate) use ($columns) {
                return $this->hydrator->extract($exchangeRate, $columns);
            }, $exchangeRates)
        );
    }

    /**
     * Может кто-то захочет очистить таблицу с курсами валют, чтобы заново выгрезить из апи
     * @return bool
     */
    public function clear(): bool
    {
        return $this->db->delete($this->tableName());
    }
}
