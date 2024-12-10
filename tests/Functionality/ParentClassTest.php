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
final class ParentClassTest extends TestCase
{
    protected DefaultAccessInterface $defaultAccessor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->defaultAccessor = DefaultAccessor::create();
    }

    public function testProtectedProperty(): void
    {
        $incValue = 'protected inc';
        $foo = new Foo(null, null, null, null, null, $incValue);

        $value = 'bat protected update';

        $this->assertSame($incValue, $this->defaultAccessor->getValue($foo, 'protectedPropertyBar'));

        $this->defaultAccessor->setValue($foo, 'protectedPropertyBar', $value);
        $this->assertSame($value, $this->defaultAccessor->getValue($foo, 'protectedPropertyBar'));
        $this->assertSame($value, $foo->getProtectedPropertyBar());
    }

    public function testPrivateProperty(): void
    {
        $incValue = 'private inc';
        $foo = new Foo(null, null, null, null, null, null, $incValue);

        $value = 'bar private update';

        $this->assertSame($incValue, $this->defaultAccessor->getValue($foo, 'privatePropertyBar'));

        $this->defaultAccessor->setValue($foo, 'privatePropertyBar', $value);
        $this->assertSame($value, $this->defaultAccessor->getValue($foo, 'privatePropertyBar'));
        $this->assertSame($value, $foo->getPrivatePropertyBar());
    }

    public function testPrivateStaticProperty(): void
    {
        $incValue = 'private static inc';
        $foo = new Foo(null, null, null, null, null, null, null, null, $incValue);

        $value = 'bar private static update';

        $this->assertSame($incValue, $this->defaultAccessor->getValue($foo, 'privateStaticPropertyBar'));

        $this->defaultAccessor->setValue($foo, 'privateStaticPropertyBar', $value);
        $this->assertSame($value, $this->defaultAccessor->getValue($foo, 'privateStaticPropertyBar'));
        $this->assertSame($value, $foo->getPrivateStaticPropertyBar());
    }

    public function testProtectedStaticProperty(): void
    {
        $incValue = 'protected static inc';
        $foo = new Foo(null, null, null, null, null, null, null, $incValue);


        $value = 'bar protected static update';

        $this->assertSame($incValue, $this->defaultAccessor->getValue($foo, 'protectedStaticPropertyBar'));

        $this->defaultAccessor->setValue($foo, 'protectedStaticPropertyBar', $value);
        $this->assertSame($value, $this->defaultAccessor->getValue($foo, 'protectedStaticPropertyBar'));
        $this->assertSame($value, $foo->getProtectedStaticPropertyBar());
    }


    public function testPrivateFunction(): void
    {
        $incValue = 'private inc';
        $foo = new Foo(null, null, null, null, null, null, $incValue);

        $value = 'bar function private update';

        $this->assertSame($incValue, $foo->getPrivatePropertyBar());

        $this->defaultAccessor->callSetter($foo, 'setPrivateFunBar', $value);
        $this->assertSame($value, $this->defaultAccessor->callGetter($foo, 'getPrivateFunBar'));
        $this->assertSame($value, $foo->getPrivatePropertyBar());
    }

    public function testPrivateStaticFunction(): void
    {
        $incValue = 'private static inc';
        $foo = new Foo(null, null, null, null, null, null, null, null, $incValue);

        $value = 'bar function private static update';

        $this->assertSame($incValue, $foo->getPrivateStaticPropertyBar());

        $this->defaultAccessor->callSetter($foo, 'SetPrivateStaticFunBar', $value);
        $this->assertSame($value, $this->defaultAccessor->callGetter($foo, 'getPrivateStaticFunBar'));
        $this->assertSame($value, $foo->getPrivateStaticPropertyBar());
    }

    public function testProtectedFunction(): void
    {
        $incValue = 'protected inc';
        $foo = new Foo(null, null, null, null, null, $incValue);

        $value = 'bar function protected update';

        $this->assertSame($incValue, $foo->getProtectedPropertyBar());

        $this->defaultAccessor->callSetter($foo, 'setProtectedFunBar', $value);
        $this->assertSame($value, $this->defaultAccessor->callGetter($foo, 'getProtectedFunBar'));
        $this->assertSame($value, $foo->getProtectedPropertyBar());
    }

    public function testProtectedStaticFunction(): void
    {
        $incValue = 'protected static inc';
        $foo = new Foo(null, null, null, null, null, null, null, $incValue);

        $value = 'bar function protected static update';

        $this->assertSame($incValue, $foo->getProtectedStaticPropertyBar());

        $this->defaultAccessor->callSetter($foo, 'SetProtectedStaticFunBar', $value);
        $this->assertSame($value, $this->defaultAccessor->callGetter($foo, 'getProtectedStaticFunBar'));
        $this->assertSame($value, $foo->getProtectedStaticPropertyBar());
    }
}
