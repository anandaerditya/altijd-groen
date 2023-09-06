<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ItemService implements ServiceInterface
{
    private Builder $builder;
    private Builder $category;
    private Builder $unit;

    public function __construct()
    {
        $this->builder = DB::table('items')
            ->join('users', 'items.user_id', '=', 'users.id')
            ->join('item_categories', 'items.category_code', '=', 'item_categories.code')
            ->join('item_units', 'items.unit_code', '=', 'item_units.code');
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
     * @param $id
     * @return LengthAwarePaginator
     */
    public function all($id): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $data = $this->builder->select([
            'items.id',
            'item_categories.name as category',
            'item_units.name as unit',
            'items.code',
            'items.name as prod_name',
            'items.quantity',
            'users.name'
        ])->where('items.user_id', $id);
        return $data->paginate(5);
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
