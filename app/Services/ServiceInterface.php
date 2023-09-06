<?php

namespace App\Services;

interface ServiceInterface
{
    /**
     * @param $data
     * @return bool|array
     */
    public function add($data): bool|array;

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function update($id, $data): bool;

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool;

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param $id
     * @return array
     */
    public function get($id): array;

    public function where($parameter, $value);
}
