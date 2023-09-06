<?php

namespace App\Services;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ItemService implements ServiceInterface
{
    private Builder $builder;
    private Builder $category;
    private Builder $unit;

    public function __construct()
    {
        $this->builder = DB::table('items')->join('users', 'items.user_id', '=', 'users.id');
        $this->category = DB::table('item_categories');
        $this->unit = DB::table('item_units');
    }

    /**
     * @param $data
     * @return false
     */
    public function add($data): bool
    {
        # Perform Insertion
        DB::beginTransaction();
        $exec = $this->builder->insert($data);
        DB::commit();
        if (!$exec) {
            return false;
        }

        return true;
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function update($id, $data): bool
    {
        $source = $this->builder->where('id', $id);
        if ($source->exists()) {
            $exec = $source->update($data);
            if (!$exec) {
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $source = $this->builder->where('id', $id);
        if ($source->exists()) {
            $exec = $source->delete();
            if (!$exec) {
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $data = $this->builder->select(['items.id', 'items.category_code', 'items.unit_code', 'items.code', 'items.name', 'items.quantity', 'users.name']);
        return $data->get()->toArray();
    }

    /**
     * @param $id
     * @return array
     */
    public function get($id): array
    {
        return [];
    }

    public function where($parameter, $value): bool|Builder
    {
        return $this->builder->where($parameter, $value);
    }
}
