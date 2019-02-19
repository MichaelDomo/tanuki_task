<?php

namespace src\Repositories;

interface CacheInterface
{
    public function get(string $key, $default = null);
    public function set(string $key, $value, $duration = null);
}
