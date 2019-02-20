<?php

namespace src\Repositories;

interface ConnectionInterface
{
    /**
     * @param string $table
     * @param array $columns
     * @param array $data
     * @return bool
     */
    public function batchInsert(string $table, array $columns, array $data): bool;

    /**
     * @param string $table
     * @return bool
     */
    public function delete(string $table): bool;

    /**
     * @param string $table
     * @return array
     */
    public function queryAll(string $table): array;

    /**
     * @param string $table
     * @param array $condition
     * @return array
     */
    public function queryOne(string $table, array $condition): array;
}
