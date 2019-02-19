<?php

namespace src\Repositories;

use src\Entities\ExchangeRate;

interface HydratorInterface
{
    /**
     * Преобразовываем полученные данные в объект определённого типа
     *
     * @param string $class
     * @param array $data
     * @return mixed
     */
    public function hydrate(string $class, array $data);

    /**
     * Преобразовываем объект в массив для записи в базу
     *
     * @param mixed|ExchangeRate $object
     * @param array $fields
     * @return array
     */
    public function extract($object, array $fields): array;
}
