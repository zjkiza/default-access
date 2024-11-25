<?php

declare(strict_types=1);

namespace Zjk\Accessor\Property\Strategy;

use Closure;
use Zjk\Accessor\Contract\PropertyAccessInterface;

/**
 * @psalm-suppress PossiblyNullFunctionCall
 */
final class StaticPropertyAccess implements PropertyAccessInterface
{
    public function canAccess(\ReflectionProperty $reflectionProperty): bool
    {
        return $reflectionProperty->isStatic();
    }

    public function setValue(object $object, string $class, string $property, mixed $value): void
    {
        Closure::bind(static function (mixed $value) use ($property): void {
            self::${$property} = $value;
        }, null, $class)($value);
    }

    public function getValue(object $object, string $class, string $property): mixed
    {
        return Closure::bind(static fn (): mixed => self::${$property}, null, $class)();
    }
}
