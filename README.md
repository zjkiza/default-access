# PHP Package: Default Accessor

A package for easily accessing and invoking private and protected properties and methods, as well as static ones. It also supports access to the methods and properties of the parent class.

# About the Package

This package provides a practical way to access and manage private and protected methods and properties in PHP objects through the `Zjk\Accessor\Contract\DefaultAccessInterface`.

# Methods for Managing Properties and Methods

- `callSetter(object $object, string $method, mixed $value): void`
  - Invokes a setter method on an object to assign a value.

- `callGetter(object $object, string $method): mixed`
  - Invokes a getter method on an object to retrieve a value.
  
- `callMethod(object $object, string $method, array $arguments = []): mixed`
  - Allows the invocation of any private or protected method, including those with multiple arguments. It also supports the naming of the argument.
  - Useful for: Methods that require complex parameters or perform combined operations like setting and retrieving values.

- `setValue(object $object, string $property, mixed $value): void`
  - Provides direct access to assign a value to a private or protected property.
  
- `getValue(object $object, string $property): mixed`
  - Provides direct access to retrieve the value of a private or protected property.

This tool is ideal for scenarios such as testing, debugging, or working with complex objects where modifying the visibility of methods and properties is not possible or practical.

# Installation

Add the package to your composer.json file:
```
composer require zjkiza/default-access
```
If you're using the Composer autoloader, all necessary files will be automatically included.

# Working with the Package

 ## Usage Without a Framework 

If you're working in a plain PHP project without a framework, you can directly use the `DefaultAccessor::create()` class. This class implements the DefaultAccessInterface and provides access to all its methods.

```php
    use Zjk\Accessor\DefaultAccessor;
    
    $accessor = DefaultAccessor::create();
    
    $object = new SomeClass();
    $accessor->setValue($object, 'propertyName', 'value');
    $value = $accessor->getValue($object, 'propertyName');

```

## Usage with a Framework

If you're using a PHP framework, you can integrate this package through dependency injection. 

1. Register the Interface and Implementation:
   - Configure the `Zjk\Accessor\Contract\DefaultAccessInterface` interface to instantiate the `Zjk\Accessor\DefaultAccessor` class.
   - This allows the `DefaultAccessInterface` to be injected into any class within the framework.

2. Direct Usage:
   - Alternatively, you can use the static `DefaultAccessor::create()` method for instantiation without additional configuration.

### Example in Symfony

- Service registration in services.yaml:
  ```yaml
    services:
        Zjk\Accessor\Contract\DefaultAccessInterface:
            class: Zjk\Accessor\DefaultAccessor

    ```
- Usage in a code:

    ```php
        public function someAction(Zjk\Accessor\Contract\DefaultAccessInterface $accessor)
        {
            $accessor->callSetter($object, 'setProperty', 'value');
        }
    ```

### Example in Laravel

- Add the binding in a service provider, such as `AppServiceProvider`

    ```php
    use Zjk\Accessor\Contract\DefaultAccessInterface;
    use Zjk\Accessor\DefaultAccessor;
    
    public function register()
    {
        $this->app->bind(DefaultAccessInterface::class, function () {
            return DefaultAccessor::create();
        });
    }
    
    ```
- Usage in a code:

    ```php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use Zjk\Accessor\Contract\DefaultAccessInterface;
    
    class ExampleController extends Controller
    {
        protected DefaultAccessInterface $accessor;
    
        public function __construct(DefaultAccessInterface $accessor)
        {
            $this->accessor = $accessor;
        }
    
        public function modifyObject()
        {
            $object = new SomeClass();
    
            // Set a private property
            $this->accessor->setValue($object, 'privateProperty', 'newValue');
    
            // Get the private property's value
            $value = $this->accessor->getValue($object, 'privateProperty');
    
            return response()->json(['value' => $value]);
        }
    }
    ```
# Package Benefits

- **Flexibility**: Enables interaction with objects that have private or protected attributes/methods without modifying their visibility.
- **Testing Efficiency**: Facilitates isolating and validating the behavior of encapsulated objects in unit tests.
- **Simplicity**: Provides a clean and intuitive API for day-to-day use.

This package is an excellent tool for advanced PHP developers who need a powerful and practical way to access "hidden" parts of objects without compromising object-oriented design principles.

# Example :

```php
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
    
    protected function getWithMultipleArguments(string $name, int $number): string
    {
        return $name.$number;
    }

    protected function setWithMultipleArguments(string $name, int $number): void
    {
        $this->protectedPropertyFoo = $name.$number;
    }
}

$bar = new Bar('property 1', 'property 2', 'property 3', 'property 4');

DefaultAccessor::create()->callSetter($bar, 'setPrivate', 'Input bar');
$protectedValue =  DefaultAccessor::create()->callGetter($bar, 'getProtected');

DefaultAccessor::create()->setValue($bar, 'protectedStaticPropertyBar', 'input static');
$protectedStaticValue = DefaultAccessor::create()->getValue($bar, 'protectedStaticProperty');

$this->defaultAccessor->callMethod($foo, 'setWithMultipleArguments', ['Foo', 11]);
$this->defaultAccessor->callMethod($foo, 'setWithMultipleArguments', [
    'number' => 11,
    'name' => 'Foo',
]);
$value = $this->defaultAccessor->callMethod($foo, 'getMultipleArguments', ['Foo', 11]);
$value = $this->defaultAccessor->callMethod($foo, 'getProtectedFuncFoo');
```
