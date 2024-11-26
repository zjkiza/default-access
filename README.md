# PHP package

To easily access and invoke private and protected properties and methods as with static.

# About the package

For access and invoke, an interface `Zjk\Accessor\Contract\DefaultAccessInterface` with methods is at your disposal:
- `public function callSetter(object $object, string $method, mixed $value): void` access method for value assignment,
- `public function callGetter(object $object, string $method): mixed` method access to get the value,
- `public function callMethod(object $object, string $method, array $arguments = []): mixed` can work for set and get value methods where multiple arguments can be passed via string.,
- `public function setValue(object $object, string $property, mixed $value): void` access property for value assignment,
- `public function getValue(object $object, string $property): mixed` property access to get the value,

# Installation

Add "zjkiza/default-access" to your composer.json file:

```
composer require zjkiza/default-access
```

# Working with the package 

- If you work in PHP without a framework, you have a direct instance of the `DefaultAccessor::create()` class at your disposal, which allows you to access the methods of the `DefaultAccessInterface` interface.
- If you work with the framework, and you want to go via dependency injection, you need to set the interface `Zjk\Accessor\Contract\DefaultAccessInterface` to instantiate the class `Zjk\Accessor\DefaultAccessor`. Of course, you can also directly use the instance of the `DefaultAccessor::create()` class in the framework.

```php

final class Foo {

class Bar
{
    private ?string  $privateProperty;
    private static ?string $privateStaticProperty;
    protected ?string  $protectedProperty;
    protected static ?string $protectedStaticProperty;

    public function __construct(
        ?string  $protectedPropertyBar = null,
        ?string  $privatePropertyBar = null,
        ?string  $protectedStaticProperty = null,
        ?string  $privateStaticProperty = null,
    ) {
        $this->protectedProperty = $protectedPropertyBar;
        $this->privateProperty = $privatePropertyBar;
        self::$protectedStaticProperty = $protectedStaticProperty;
        self::$privateStaticProperty = $privateStaticProperty;
    }

     private function getPrivate(): string
    {
        return $this->privateProperty;
    }

    private function setPrivate(string $name): void
    {
        $this->privateProperty = $name;
    }

    protected function getProtected(): string
    {
        return $this->protectedProperty;
    }

    protected function setProtected(string $name): void
    {
        $this->protectedProperty = $name;
    }

    private static function getPrivateStatic(): string
    {
        return self::$privateStaticProperty;
    }

    private static function SetPrivateStatic(string $name): void
    {
        self::$privateStaticProperty = $name;
    }

    protected static function getProtectedStatic(): string
    {
        return self::$protectedStaticProperty;
    }

    protected static function SetProtectedStatic(string $name): void
    {
        self::$protectedStaticProperty = $name;
    }
    
}

$bar = new Bar('property 1', 'property 2', 'property 3', 'property 4');

DefaultAccessor::create()->callSetter($bar, 'setPrivate', 'Input bar');
$protectedValue =  DefaultAccessor::create()->callGetter($bar, 'getProtected');
DefaultAccessor::create()->callMethod(object $object, string $method, array $arguments = []);
DefaultAccessor::create()->setValue($bar, 'protectedStaticPropertyBar', 'input static');
$protectedStaticValue = DefaultAccessor::create()->getValue($bar, 'protectedStaticProperty');

```
