<?php

declare(strict_types=1);

namespace Zjk\Accessor;

use Zjk\Accessor\Exception\InvalidMethodException;
use Zjk\Accessor\Exception\InvalidPropertyException;

/**
 * @return class-string
 */
function findClassWithProperty(object $object, string $property): string
{
    $class = $object::class;

    while ($class) {
        if (\property_exists($class, $property)) {

            return $class;
        }
        $class = \get_parent_class($class);
    }

    throw new InvalidPropertyException(\sprintf('Property "%s" does not exist in class "%s".', $property, $object::class));
}

/**
 * @return class-string
 */
function findClassWithMethod(object $object, string $method): string
{
    $class = $object::class;

    while ($class) {
        if (\method_exists($class, $method)) {

            return $class;
        }
        $class = \get_parent_class($class);
    }

    throw new InvalidMethodException(\sprintf('Method "%s" does not exist in class "%s".', $method, $object::class));
}
