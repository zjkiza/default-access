<?php

declare(strict_types=1);

namespace Zjk\Accessor\Property;

use ReflectionProperty;
use Zjk\Accessor\Contract\PropertyAccessInterface;
use Zjk\Accessor\Contract\StrategyPropertyAccessInterface;
use Zjk\Accessor\Exception\NotExistStrategy;
use Zjk\Accessor\Property\Strategy\PropertyAccess;
use Zjk\Accessor\Property\Strategy\StaticPropertyAccess;

use function Zjk\Accessor\findClassWithProperty;

final class StrategyPropertyAccess implements StrategyPropertyAccessInterface
{
    /** @var PropertyAccessInterface[] */
    private array $propertyAccess = [];

    public function __construct()
    {
        $this
            ->addPropertyAccess(new PropertyAccess())
            ->addPropertyAccess(new StaticPropertyAccess());
    }

    public function addPropertyAccess(PropertyAccessInterface $propertyAccess): self
    {
        $this->propertyAccess[] = $propertyAccess;

        return $this;
    }

    public function setValue(object $object, string $property, mixed $value): void
    {
        $class = findClassWithProperty($object, $property);
        $reflectionProperty = new ReflectionProperty($class, $property);

        foreach ($this->propertyAccess as $access) {
            if ($access->canAccess($reflectionProperty)) {
                $access->setValue($object, $class, $property, $value);
                return;
            }
        }

        throw new NotExistStrategy(\sprintf('No strategy was found to access property "%s" in class "%s"', $property, $object::class));
    }

    public function getValue(object $object, string $property): mixed
    {
        $class = findClassWithProperty($object, $property);
        $reflectionProperty = new ReflectionProperty($class, $property);

        foreach ($this->propertyAccess as $access) {
            if ($access->canAccess($reflectionProperty)) {
                return $access->getValue($object, $class, $property);
            }
        }

        throw new NotExistStrategy(\sprintf('No strategy was found to access property "%s" in class "%s"', $property, $object::class));
    }
}
