<?php

declare(strict_types=1);

namespace Zjk\Accessor\Contract;

interface PropertyAccessInterface
{
    public function canAccess(\ReflectionProperty $reflectionProperty): bool;

    public function setValue(object $object, string $class, string $property, mixed $value): void;

    public function getValue(object $object, string $class, string $property): mixed;
}
