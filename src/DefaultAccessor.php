<?php

declare(strict_types=1);

namespace Zjk\Accessor;

use Zjk\Accessor\Contract\DefaultAccessInterface;
use Zjk\Accessor\Contract\MethodAccessInterface;
use Zjk\Accessor\Contract\StrategyPropertyAccessInterface;
use Zjk\Accessor\Method\MethodAccess;
use Zjk\Accessor\Property\StrategyPropertyAccess;

final class DefaultAccessor implements DefaultAccessInterface
{
    public function __construct(
        private readonly MethodAccessInterface $methodAccess,
        private readonly StrategyPropertyAccessInterface $propertyAccess
    ) {
    }

    #[\Override]
    public function callSetter(object $object, string $method, mixed $value): void
    {
        $this->methodAccess->callSetter($object, $method, $value);
    }

    #[\Override]
    public function callGetter(object $object, string $method): mixed
    {
        return $this->methodAccess->callGetter($object, $method);
    }

    #[\Override]
    public function callMethod(object $object, string $method, array $arguments = []): mixed
    {
        return $this->methodAccess->callMethod($object, $method, $arguments);
    }

    #[\Override]
    public function setValue(object $object, string $property, mixed $value): void
    {
        $this->propertyAccess->setValue($object, $property, $value);
    }

    #[\Override]
    public function getValue(object $object, string $property): mixed
    {
        return $this->propertyAccess->getValue($object, $property);
    }

    public static function create(
        ?MethodAccessInterface $methodAccess = null,
        ?StrategyPropertyAccessInterface $propertyAccess = null,
    ): self {
        $methodAccess ??= new MethodAccess();
        $propertyAccess ??= new StrategyPropertyAccess();

        return new self($methodAccess, $propertyAccess);
    }
}
