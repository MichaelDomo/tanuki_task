<?php

namespace src\Repositories;

interface CacheInterface
{
    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * @param string $key
     * @param $value
     * @param null $duration
     * @return bool
     */
    public function set(string $key, $value, $duration = null): bool;

    /**
     * @param string $key
     * @return bool
     */
    public function delete(string $key): bool;

    /**
     * @param string $key
     * @return array|null
     */
    public function keys(string $key): ?array;
}
