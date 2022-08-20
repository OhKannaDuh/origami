<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\Request;
use App\Models\User;
use App\StringHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

abstract class RequestTest extends TestCase
{


    abstract protected function providerRequiredRules(): array;


    abstract protected function getRequestClass(): string;


    abstract protected function getPayload(): array;


    protected function getUser(): User
    {
        return User::factory()->create();
    }


    protected function validate(Request $request): void
    {
        Validator::make($request->validationData(), $request->rules())->validate();
    }


    /**
     * @dataProvider providerRequiredRules
     */
    public function testRequiredRules(string $rule, string $message = ''): void
    {
        $this->expectException(ValidationException::class);

        if ($message === '') {
            $key = StringHelper::replace('_', ' ', $rule);
            $message = "The {$key} field is required.";
        }

        $this->expectExceptionMessage($message);

        $payload = Arr::except($this->getPayload(), $rule);
        $request = $this->getRequest($payload);

        $request = $this->getRequest($payload);
        $this->validate($request);
    }


    public function testRequestAcceptPayload(): void
    {
        $payload = $this->getPayload();
        $request = $this->getRequest($payload);

        $request = $this->getRequest($payload);
        $validator = Validator::make($request->validationData(), $request->rules());

        if ($validator->fails()) {
            dd($validator->failed());
        }

        self::assertFalse($validator->fails());
    }


    protected function getRequest(array $payload): Request
    {
        $class = $this->getRequestClass();
        assert(class_exists($class));
        assert(is_subclass_of($class, Request::class));

        /** @var Request $request */
        $request = new $class($payload);

        $request->setUserResolver(fn (): User => $this->getUser());

        return $request;
    }
}
