<?php

declare(strict_types=1);

namespace Zjk\Accessor\Tests\Resources;

class Bar
{
    private static ?string $privateStaticPropertyBar = null;
    protected static ?string $protectedStaticPropertyBar = null;
    protected ?string  $protectedPropertyBar;
    private ?string  $privatePropertyBar;

    public function __construct(
        ?string  $protectedPropertyBar = null,
        ?string  $privatePropertyBar = null,
        ?string  $protectedStaticPropertyBar = null,
        ?string  $privateStaticPropertyBar = null,
    ) {
        $this->protectedPropertyBar = $protectedPropertyBar;
        $this->privatePropertyBar = $privatePropertyBar;
        self::$protectedStaticPropertyBar = $protectedStaticPropertyBar;
        self::$privateStaticPropertyBar = $privateStaticPropertyBar;
    }

    public function getProtectedPropertyBar(): ?string
    {
        return $this->protectedPropertyBar;
    }

    public function getPrivatePropertyBar(): ?string
    {
        return $this->privatePropertyBar;
    }

    public function getPrivateStaticPropertyBar(): ?string
    {
        return self::$privateStaticPropertyBar;
    }

    public function getProtectedStaticPropertyBar(): ?string
    {
        return self::$protectedStaticPropertyBar;
    }

    private function getPrivateFunBar(): string
    {
        return $this->privatePropertyBar;
    }

    private function setPrivateFunBar(string $name): void
    {
        $this->privatePropertyBar = $name;
    }

    protected function getProtectedFunBar(): string
    {
        return $this->protectedPropertyBar;
    }

    protected function setProtectedFunBar(string $name): void
    {
        $this->protectedPropertyBar = $name;
    }

    private static function getPrivateStaticFunBar(): string
    {
        return self::$privateStaticPropertyBar;
    }

    private static function SetPrivateStaticFunBar(string $name): void
    {
        self::$privateStaticPropertyBar = $name;
    }

    protected static function getProtectedStaticFunBar(): string
    {
        return self::$protectedStaticPropertyBar;
    }

    protected static function SetProtectedStaticFunBar(string $name): void
    {
        self::$protectedStaticPropertyBar = $name;
    }
}
