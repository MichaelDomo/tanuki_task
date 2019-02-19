<?php

namespace src\Repositories;

interface ConnectionInterface
{
    public function batchInsert(string $table, array $columns, array $data): bool;
    public function delete(string $table): bool;
    public function queryAll(string $table): array;
    public function queryOne(string $table, array $condition): array;
}
