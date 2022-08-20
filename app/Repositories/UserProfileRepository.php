<?php

namespace App\Repositories;

use App\Models\UserProfile;

class UserProfileRepository 
{
    private $model;

    public function __construct(UserProfile $model)
    {
        $this->model = $model;
    }

    public function findByColumn($value, $column)
    {
        return $this->model->where($column, $value)->first();
    }

    public function store(UserProfile $userProfile)
    {
        $userProfile = $userProfile->save();
        
        return $userProfile;
    }
}