<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

class ApiExchangeRateRepository implements ReadExchangeRateRepositoryInterface
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
    private function url(): string
    {
        return 'http://exchange-rate.com';
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $result = $this->client->sendRequest($this->url());

        return $this->hydrator->hydrate(ExchangeRate::class, $result);
    }

    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return null|ExchangeRate
     */
    public function findExchange(string $currencyFrom, string $currencyTo): ?ExchangeRate
    {
        $response = $this->client->sendRequest(
            $this->url(),
            ['currency_from' => $currencyFrom, 'currency_to' => $currencyTo]
        );

        if (!empty($response)) {
            $result = $this->hydrator->hydrate(ExchangeRate::class, $response);

            return $result[0];
        }

        return null;
    }
}
