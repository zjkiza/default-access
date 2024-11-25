<?php

declare(strict_types=1);

namespace Zjk\Accessor\Contract;

interface MethodAccessInterface
{
    public function callSetter(object $object, string $method, mixed $value): void;

    public function callGetter(object $object, string $method): mixed;

    /**
     * @param mixed[] $arguments
     */
    public function callMethod(object $object, string $method, array $arguments = []): mixed;
}
