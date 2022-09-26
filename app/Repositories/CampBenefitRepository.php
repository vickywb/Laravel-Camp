<?php

namespace App\Repositories;

use App\Models\CampBenefit;

class CampBenefitRepository 
{
    private $model;

    public function __construct(CampBenefit $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $campBenefits = $this->model
            ->when(!empty($params['with']), function ($query) use ($params) {
                return $query->with($params['with']);
            })
            ->when(!empty($params['order']), function ($query) use ($params) {
                return $query->orderByRaw($params['order']);
            });
        if (!empty($params['pagination'])) {
            return $campBenefits->paginate($params['pagination'], ['*'], isset($params['pagination_name']) ? $params['pagination_name'] : 'page');
        }

        return $campBenefits->get();
    }

    public function findByColumn($value, $column)
    {
        return $this->model->where($column, $value)->first();
    }

    public function store(CampBenefit $campBenefit)
    {
        $campBenefit->save();

        return $campBenefit;
    }
}