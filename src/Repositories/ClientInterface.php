<?php

namespace src\Repositories;

interface ClientInterface
{
    /**
     * @param string $url
     * @param array $queryParams
     * @return array
     */
    public function sendRequest(string $url, array $queryParams = []): array;
}
