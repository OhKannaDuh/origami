<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\App;

final class UserRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(UserRepository::class);
    }


    protected function getModelData(): array
    {
        return User::factory()->definition();
    }


    protected function getAdditionalCreateData(): array
    {
        return [
            'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ];
    }


    protected function getUpdateData(): array
    {
        return [
            'name' => fake()->userName(),
        ];
    }


    protected function getSkipModelComparisonKeys(): array
    {
        return [
            // Password is hashed so we can't compare it to input data.
            'password',
        ];
    }
}
