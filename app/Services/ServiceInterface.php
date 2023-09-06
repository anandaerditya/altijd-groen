<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * @param $id
     * @return array|LengthAwarePaginator
     */
    public function all($id): array|\Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * @param $id
     * @return array
     */
    public function get($id): array;

    public function where($parameter, $value);
}
