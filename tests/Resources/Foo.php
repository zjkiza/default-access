<?php

declare(strict_types=1);

namespace Zjk\Accessor\Tests\Resources;

final class Foo extends Bar
{
    public ?string  $publicPropertyFoo;
    private static ?string $staticPrivatePropertyFoo = null;
    private ?string  $privatePropertyFoo;
    protected ?string  $protectedPropertyFoo;
    protected static ?string $staticProtectedPropertyFoo = null;

    public function __construct(
        ?string  $publicPropertyFoo = null,
        ?string  $protectedPropertyFoo = null,
        ?string  $staticProtectedPropertyFoo = null,
        ?string  $privatePropertyFoo = null,
        ?string  $staticPrivatePropertyFoo = null,
        ?string  $protectedPropertyBar = null,
        ?string  $privatePropertyBar = null,
        ?string  $protectedStaticPropertyBar = null,
        ?string  $privateStaticPropertyBar = null,
    ) {
        parent::__construct($protectedPropertyBar, $privatePropertyBar, $protectedStaticPropertyBar, $privateStaticPropertyBar);

        $this->publicPropertyFoo = $publicPropertyFoo;
        $this->protectedPropertyFoo = $protectedPropertyFoo;
        self::$staticProtectedPropertyFoo = $staticProtectedPropertyFoo;
        $this->privatePropertyFoo = $privatePropertyFoo;
        self::$staticPrivatePropertyFoo = $staticPrivatePropertyFoo;
    }

    public static function staticPrivatePropertyFooValue(): ?string
    {
        return self::$staticPrivatePropertyFoo;
    }

    public static function staticProtectedPropertyFooValue(): ?string
    {
        return self::$staticProtectedPropertyFoo;
    }

    public function getPublicFuncFoo(): string
    {

        return $this->publicPropertyFoo;
    }

    public function setPublicFuncFoo(string $name): void
    {
        $this->publicPropertyFoo = $name;
    }

    public function privatePropertyValue(): string
    {
        return $this->privatePropertyFoo;
    }

    public function protectedPropertyValue(): string
    {
        return $this->protectedPropertyFoo;
    }

    private function getPrivateFuncFoo(): string
    {
        return $this->privatePropertyFoo;
    }

    private function setPrivateFuncFoo(string $name): void
    {
        $this->privatePropertyFoo = $name;
    }

    private static function getStaticPrivateFuncFoo(): ?string
    {
        return self::$staticPrivatePropertyFoo;
    }

    private static function setStaticPrivateFuncFoo(string $name): void
    {
        self::$staticPrivatePropertyFoo = $name;
    }

    protected function getProtectedFuncFoo(): string
    {
        return $this->protectedPropertyFoo;
    }

    protected function setProtectedFuncFoo(string $name): void
    {
        $this->protectedPropertyFoo = $name;
    }

    protected static function getStaticProtectedFuncFoo(): ?string
    {
        return self::$staticProtectedPropertyFoo;
    }

    protected static function setStaticProtectedFuncFoo(string $name): void
    {
        self::$staticProtectedPropertyFoo = $name;
    }
    protected function getMultipleArguments(string $name, int $number): string
    {
        return $name.$number;
    }

    protected function setMultipleArguments(string $name, int $number): void
    {
        $this->protectedPropertyFoo = $name.$number;
    }
}
