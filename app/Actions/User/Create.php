<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

final class Create implements CreateInterface
{


    public function __construct(
        private UserRepositoryInterface $users
    ) {
    }


    public function execute(array $context = []): User
    {
        $user = $this->users->create($context);
        assert($user instanceof User);

        return $user;
    }
}
