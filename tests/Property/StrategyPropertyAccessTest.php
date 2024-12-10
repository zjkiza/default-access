<?php

declare(strict_types=1);

namespace Zjk\Accessor\Tests\Property;

use PHPUnit\Framework\TestCase;
use Zjk\Accessor\DefaultAccessor;
use Zjk\Accessor\Exception\NotExistStrategy;
use Zjk\Accessor\Property\StrategyPropertyAccess;
use Zjk\Accessor\Tests\Resources\Foo;

final class StrategyPropertyAccessTest extends TestCase
{
    public function testExpectExceptionForSetValueWhenNotExistStrategy(): void
    {
        $this->expectException(NotExistStrategy::class);

        $strategy = new StrategyPropertyAccess();

        DefaultAccessor::create()->setValue($strategy, 'propertyAccess', []);

        $foo = new Foo();

        $strategy->setValue($foo, 'privatePropertyFoo', 'lorem');
    }

    public function testExpectExceptionForGetValueWhenNotExistStrategy(): void
    {
        $this->expectException(NotExistStrategy::class);

        $strategy = new StrategyPropertyAccess();

        DefaultAccessor::create()->setValue($strategy, 'propertyAccess', []);

        $foo = new Foo();

        $strategy->getValue($foo, 'privatePropertyFoo');
    }
}
