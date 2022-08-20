<?php

namespace Tests\Unit\Behaviours;

use App\Models\Character\Character;
use App\Models\User;
use App\Repositories\Character\CharacterRepository;
use App\Repositories\Core\CampaignRepository;
use App\Repositories\UserRepository;
use App\StringHelper;
use AssertionError;
use Tests\TestCase;
use Tests\Unit\Behaviours\HasRepository\ModelWithNewRepository;
use Tests\Unit\Behaviours\HasRepository\TestModel;

final class HasRepositoryTest extends TestCase
{


    /**
     * Ensure we can get the repository from a model.
     */
    public function testRepository1(): void
    {
        self::assertInstanceOf(UserRepository::class, User::repository());
    }


    /**
     * Ensure we can get the repository from a model.
     */
    public function testRepository2(): void
    {
        self::assertInstanceOf(CharacterRepository::class, Character::repository());
    }


    /**
     * Ensure we can get the repository by overriding the newRepository method in a model.
     * @see ModelWithNewRepository::newRepository
     */
    public function testRepository3(): void
    {
        self::assertInstanceOf(CampaignRepository::class, ModelWithNewRepository::repository());
    }


    /**
     * Ensure we can get the repository by overriding the newRepository method in a model.
     * @see ModelWithNewRepository::newRepository
     */
    public function testRepository4(): void
    {
        $this->expectError(AssertionError::class);
        $this->expectErrorMessage('assert($repository instanceof RepositoryInterface)');

        $namespace = StringHelper::beforeLast('\\', TestModel::class);
        $this->app['config']->set('repository.namespaces.model', $namespace);
        $this->app['config']->set('repository.namespaces.repository', $namespace);

        TestModel::repository();
    }
}
