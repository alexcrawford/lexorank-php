<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Exception;

use InvalidArgumentException;
use Throwable;

class EmptyRank extends InvalidArgumentException
{
    private function __construct(string $message = '', int $code = 0, Throwable|null $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function create(): self
    {
        return new self('Rank provided is empty.');
    }
}
