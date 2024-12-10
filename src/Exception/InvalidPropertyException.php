<?php

declare(strict_types=1);

namespace Zjk\Accessor\Exception;

use Zjk\Accessor\Contract\ExceptionInterface;

final class InvalidPropertyException extends \RuntimeException implements ExceptionInterface
{
}
