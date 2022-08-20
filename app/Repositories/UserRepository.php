<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * @extends BaseRepository<User>
 */
final class UserRepository extends BaseRepository implements UserRepositoryInterface
{


    public function __construct(User $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $context): array
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:users',
                'max:255',
            ],
            'email' => [
                'string',
                'email',
                'required',
                'unique:users',
                'max:255',
            ],
            'password' => [
                'string',
                'required',
                'min:8',
                'confirmed',
            ],
        ];
    }


    protected function processCreateData(array $data): array
    {
        $data = parent::processCreateData($data);
        $data['password'] = Hash::make($data['password']);

        return $data;
    }


    public function create(array $attributes): User
    {
        $model = parent::create($attributes);
        assert($model instanceof User);

        $model->createToken('api_token');

        return $model;
    }
}
