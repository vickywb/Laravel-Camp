<?php

namespace App\Repositories;

use App\Models\Discount;

class DiscountRepository
{
    private $model;

    public function __construct(Discount $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $discounts = $this->model
            ->when(!empty($params['with']), function ($query) use ($params) {
                return $query->with($params['with']);
            })
            ->when(!empty($params['order']), function ($query) use ($params) {
                return $query->orderByRaw($params['order']);
            });

        if (!empty($params['pagination'])) {
            return $discounts->paginate($params['pagination'], ['*'], isset($params['pagination_name']) ? $params['pagination_name'] : 'page');
        }

        return $discounts->get();
    }

    public function findByColumn($value, $column)
    {
        return $this->model->where($column, $value)->first();
    }

    public function store(Discount $discount)
    {
        $discount->save();
        
        return $discount;
    }
}