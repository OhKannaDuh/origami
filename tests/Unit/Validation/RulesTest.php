<?php

namespace Tests\Unit\Validation;

use App\Models\User;
use App\Validation\Rules;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFactory;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

final class RulesTest extends TestCase
{


    public function testExists1(): void
    {
        $user = User::factory()->create();
        $rules = (new Rules())->exists(User::class);

        self::assertIsArray($this->validated($user->getKey(), $rules));
    }


    public function testExists2(): void
    {
        $user = User::factory()->create();
        $rules = (new Rules())->exists(User::class, 'name');

        self::assertIsArray($this->validated($user->name, $rules));
    }


    public function testExists3(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectErrorMessage('The selected key is invalid.');

        $user = User::factory()->create();
        $rules = (new Rules())->exists(User::class);

        self::assertIsArray($this->validated($user->name, $rules));
    }


    public function testRequired1(): void
    {
        $rules = (new Rules())->required();

        self::assertIsArray($this->validated(['some data'], $rules));
    }


    public function testRequired2(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectErrorMessage('The key field is required.');

        $rules = (new Rules())->required();

        self::assertIsArray($this->validated([], $rules));
    }


    private function validator(mixed $data, Rules $rules): Validator
    {
        return ValidatorFactory::make([
            'key' => $data,
        ], [
            'key' => $rules->toArray(),
        ]);
    }


    private function validated(mixed $data, Rules $rules): array
    {
        return $this->validator($data, $rules)->validated();
    }


    private function validate(mixed $data, Rules $rules): array
    {
        return $this->validator($data, $rules)->validate();
    }
}
