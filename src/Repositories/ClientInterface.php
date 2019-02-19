<?php

namespace src\Repositories;

interface ClientInterface
{
    public function sendRequest(string $url, array $queryParams = []): array;
}
