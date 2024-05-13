<?php

declare(strict_types=1);

namespace App\Exceptions;

use Flame\Foundation\Contract\EnumMethodInterface;
use RuntimeException;

class CustomException extends RuntimeException
{
    public function __construct(EnumMethodInterface|string $e, $code = 0, $previous = null)
    {
        if ($e instanceof EnumMethodInterface) {
            parent::__construct($e->getDescription(), $e->getValue(), $previous);
        } else {
            parent::__construct($e, $code, $previous);
        }
    }
}
