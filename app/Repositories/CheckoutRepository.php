<?php

namespace App\Repositories;

use App\Models\Checkout;

class CheckoutRepository
{
    private $model;

    public function __construct(Checkout $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $checkouts = $this->model
            ->when(!empty($params['with']), function ($query) use ($params) {
                return $query->with($params['with']);
            })
            ->when(!empty($params['user_id']), function ($query) use ($params) {
                return $query->where('user_id', $params['user_id']);
            })
            ->when(!empty($params['order']), function ($query) use ($params) {
                return $query->orderByRaw($params['order']);
            });

        if (!empty($params['pagination'])) {
            return $checkouts->paginate($params['pagination'], ['*'], isset($params['pagination_name']) ? $params['pagination_name'] : 'page');
        }

        return $checkouts->get();
    }

    public function findByColumn($value, $column)
    {
        return $this->model->where($column, $value)->first();
    }

    public function store(Checkout $checkout)
    {
        $checkout->save();

        return $checkout;
    }
}