<?php

declare(strict_types=1);

namespace Zjk\Accessor\Property\Strategy;

use Closure;
use ReflectionProperty;
use Zjk\Accessor\Contract\PropertyAccessInterface;
use Zjk\Accessor\Contract\StrategyPropertyAccessInterface;

use function Zjk\Accessor\findClassWithProperty;

/**
 * @psalm-suppress PossiblyNullFunctionCall
 */
final class PropertyAccess implements PropertyAccessInterface
{
    public function canAccess(ReflectionProperty $reflectionProperty): bool
    {
        return !$reflectionProperty->isStatic();
    }

    public function setValue(object $object, string $class, string $property, mixed $value): void
    {
        Closure::bind(function (mixed $value) use ($property): object {
            $this->{$property} = $value;

            return $this;
        }, $object, $class)($value);
    }

    public function getValue(object $object, string $class, string $property): mixed
    {
        return Closure::bind(fn (): mixed => $this->{$property}, $object, $class)();
    }
}
