<?php

declare(strict_types=1);

namespace Zjk\Accessor\Method;

use Closure;
use Zjk\Accessor\Contract\MethodAccessInterface;

use function Zjk\Accessor\findClassWithMethod;

/**
 * @psalm-suppress PossiblyNullFunctionCall
 */
final class MethodAccess implements MethodAccessInterface
{
    public function callSetter(object $object, string $method, mixed $value): void
    {
        $scope = findClassWithMethod($object, $method);

        Closure::bind(function (mixed $value) use ($method): object {
            $this->{$method}($value);

            return $this;
        }, $object, $scope)($value);
    }

    public function callGetter(object $object, string $method): mixed
    {
        $scope = findClassWithMethod($object, $method);

        return Closure::bind(fn (): mixed => $this->{$method}(), $object, $scope)();
    }

    /**
     * @param mixed[] $arguments
     */
    public function callMethod(object $object, string $method, array $arguments = []): mixed
    {
        $scope = findClassWithMethod($object, $method);

        return Closure::bind(fn (): mixed => $this->{$method}(...$arguments), $object, $scope)();
    }
}
