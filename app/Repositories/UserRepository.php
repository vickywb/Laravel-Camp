<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $users = $this->model
            ->when(!empty($params['with']), function ($query) use ($params) {
                return $query->with($params['with']);
            })
            ->when(!empty($params['order']), function ($query) use ($params) {
                return $query->orderByRaw($params['order']);
            });
        if (!empty($params['pagination'])) {
            return $users->paginate($params['pagination'], ['*'], isset($params['pagination']) ? $params['pagination'] : 'page');
        }

        return $users->get();
    }

    public function findByColumn($value, $column)
    {
        return $this->model->where($column, $value)->first();
    }

    public function store(User $user)
    {
        if (request()->filled('password')) {
            $user->password = Hash::make($user->password);
        } else {
            $user->password = $user->getRawOriginal('password');
        }

        $user->save();
        
        return $user;
    }
}