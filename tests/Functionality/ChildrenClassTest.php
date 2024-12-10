<?php

declare(strict_types=1);

namespace Zjk\Accessor\Tests\Functionality;

use PHPUnit\Framework\TestCase;
use Zjk\Accessor\Contract\DefaultAccessInterface;
use Zjk\Accessor\DefaultAccessor;
use Zjk\Accessor\Tests\Resources\Foo;

/**
 * @psalm-suppress DocblockTypeContradiction
 */
final class ChildrenClassTest extends TestCase
{
    protected DefaultAccessInterface $defaultAccessor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->defaultAccessor = DefaultAccessor::create();
    }

    public function testPrivateProperty(): void
    {
        $incValue = 'private inc';
        $foo = new Foo(null, null, null, $incValue);

        $value = 'foo private update';

        $this->assertSame($incValue, $this->defaultAccessor->getValue($foo, 'privatePropertyFoo'));

        $this->defaultAccessor->setValue($foo, 'privatePropertyFoo', $value);
        $this->assertSame($value, $this->defaultAccessor->getValue($foo, 'privatePropertyFoo'));
        $this->assertSame($value, $foo->privatePropertyValue());
    }

    public function testPrivateStaticProperty(): void
    {
        $incValue = 'private static inc';
        $foo = new Foo(null, null, null, null, $incValue);

        $value = 'foo private static update';

        $this->assertSame($incValue, $this->defaultAccessor->getValue($foo, 'staticPrivatePropertyFoo'));

        $this->defaultAccessor->setValue($foo, 'staticPrivatePropertyFoo', $value);
        $this->assertSame($value, $this->defaultAccessor->getValue($foo, 'staticPrivatePropertyFoo'));
        $this->assertSame($value, $foo->staticPrivatePropertyFooValue());
    }

    public function testProtectedProperty(): void
    {
        $incValue = 'protected inc';
        $foo = new Foo(null, $incValue) ;

        $value = 'foo protected update';

        $this->assertSame($incValue, $this->defaultAccessor->getValue($foo, 'protectedPropertyFoo'));

        $this->defaultAccessor->setValue($foo, 'protectedPropertyFoo', $value);
        $this->assertSame($value, $this->defaultAccessor->getValue($foo, 'protectedPropertyFoo'));
        $this->assertSame($value, $foo->protectedPropertyValue());
    }

    public function testProtectedStaticProperty(): void
    {
        $incValue = 'protected static inc';
        $foo = new Foo(null, null, $incValue) ;

        $value = 'foo protected static update';

        $this->assertSame($incValue, $this->defaultAccessor->getValue($foo, 'staticProtectedPropertyFoo'));

        $this->defaultAccessor->setValue($foo, 'staticProtectedPropertyFoo', $value);
        $this->assertSame($value, $this->defaultAccessor->getValue($foo, 'staticProtectedPropertyFoo'));
        $this->assertSame($value, $foo->staticProtectedPropertyFooValue());
    }

    public function testPrivateFunction(): void
    {
        $incValue = 'private inc';
        $foo = new Foo(null, null, null, $incValue);

        $value = 'foo function private update';

        $this->assertSame($incValue, $foo->privatePropertyValue());

        $this->defaultAccessor->callSetter($foo, 'setPrivateFuncFoo', $value);
        $this->assertSame($value, $this->defaultAccessor->callGetter($foo, 'getPrivateFuncFoo'));
        $this->assertSame($value, $foo->privatePropertyValue());
    }

    public function testPrivateStaticFunction(): void
    {
        $incValue = 'private static inc';
        $foo = new Foo(null, null, null, null, $incValue);

        $value = 'foo function private static update';

        $this->assertSame($incValue, $foo->staticPrivatePropertyFooValue());

        $this->defaultAccessor->callSetter($foo, 'setStaticPrivateFuncFoo', $value);
        $this->assertSame($value, $this->defaultAccessor->callGetter($foo, 'getStaticPrivateFuncFoo'));
        $this->assertSame($value, $foo->staticPrivatePropertyFooValue());
    }

    public function testProtectedFunction(): void
    {
        $incValue = 'protected inc';
        $foo = new Foo(null, $incValue);

        $value = 'foo function protected update';

        $this->assertSame($incValue, $foo->protectedPropertyValue());

        $this->defaultAccessor->callSetter($foo, 'setProtectedFuncFoo', $value);
        $this->assertSame($value, $this->defaultAccessor->callGetter($foo, 'getProtectedFuncFoo'));
        $this->assertSame($value, $foo->protectedPropertyValue());
    }

    public function testProtectedStaticFunction(): void
    {
        $incValue = 'protected static inc';
        $foo = new Foo(null, null, $incValue);

        $value = 'foo function protected static update';

        $this->assertSame($incValue, $foo->staticProtectedPropertyFooValue());

        $this->defaultAccessor->callSetter($foo, 'setStaticProtectedFuncFoo', $value);
        $this->assertSame($value, $this->defaultAccessor->callGetter($foo, 'getStaticProtectedFuncFoo'));
        $this->assertSame($value, $foo->staticProtectedPropertyFooValue());
    }

    public function testGetMultipleArguments(): void
    {
        $foo = new Foo();

        $value = $this->defaultAccessor->callMethod($foo, 'getMultipleArguments', ['Foo', 11]);

        $this->assertSame('Foo11', $value);
    }
    public function testSetMultipleArgumentsAndCallGetFunction(): void
    {
        $foo = new Foo();

        $this->defaultAccessor->callMethod($foo, 'setMultipleArguments', ['Foo', 11]);

        $value = $this->defaultAccessor->callMethod($foo, 'getProtectedFuncFoo');

        $this->assertSame('Foo11', $value);
    }

    public function testSetMultipleArgumentsAndCallGetFunctionWithNamedArguments(): void
    {
        $foo = new Foo();

        $this->defaultAccessor->callMethod($foo, 'setMultipleArguments', [
            'number' => 11,
            'name' => 'Foo',
        ]);

        $value = $this->defaultAccessor->callMethod($foo, 'getProtectedFuncFoo');

        $this->assertSame('Foo11', $value);
    }
}
