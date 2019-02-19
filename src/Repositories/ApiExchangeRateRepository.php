<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

class ApiExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    /**
     * @var ConnectionInterface
     */
    private $client;
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @param HydratorInterface $hydrator
     * @param ClientInterface $client
     */
    public function __construct(HydratorInterface $hydrator, ClientInterface $client)
    {
        $this->client = $client;
        $this->hydrator = $hydrator;
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return 'http://exchange-rate.com';
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        $result = $this->client->sendRequest($this->url());

        return $this->hydrator->hydrate(ExchangeRate::class, $result);
    }

    /**
     * @inheritdoc
     */
    public function findExchange(string $currencyFrom, string $currencyTo): ExchangeRate
    {
        $result = $this->client->sendRequest(
            $this->url(),
            ['currency_from' => $currencyFrom, 'currency_to' => $currencyTo]
        );

        return $this->hydrator->hydrate(ExchangeRate::class, $result);
    }
}
