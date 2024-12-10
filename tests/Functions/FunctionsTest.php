<?php

declare(strict_types=1);

namespace Zjk\Accessor\Tests\Functions;

use PHPUnit\Framework\TestCase;
use Zjk\Accessor\Exception\InvalidMethodException;
use Zjk\Accessor\Exception\InvalidPropertyException;
use Zjk\Accessor\Tests\Resources\Foo;

use function Zjk\Accessor\findClassWithMethod;
use function Zjk\Accessor\findClassWithProperty;

final class FunctionsTest extends TestCase
{
    public function testExpectExceptionWhenPropertyNotExistInClass(): void
    {
        $property = 'lorem';
        $this->expectException(InvalidPropertyException::class);
        $this->expectExceptionMessage(\sprintf('Property "%s" does not exist in class "%s".', $property, Foo::class));

        findClassWithProperty(new Foo(), $property);
    }

    public function testExpectExceptionWhenMethodNotExistInClass(): void
    {
        $method = 'lorem';
        $this->expectException(InvalidMethodException::class);
        $this->expectExceptionMessage(\sprintf('Method "%s" does not exist in class "%s".', $method, Foo::class));

        findClassWithMethod(new Foo(), $method);
    }
}
