<?php

declare(strict_types=1);

namespace Zjk\Accessor\Contract;

interface StrategyPropertyAccessInterface
{
    public function setValue(object $object, string $property, mixed $value): void;

    public function getValue(object $object, string $property): mixed;
}
