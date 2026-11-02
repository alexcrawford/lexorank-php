<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\InvalidChars;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(InvalidChars::class)]
final class InvalidCharsTest extends TestCase
{
    public function testForInputRankWithInvalidChars(): void
    {
        $exception = InvalidChars::forInputRankWithInvalidChars('testRank', ['A', 'Z']);

        self::assertSame('Rank provided contains an invalid Char. Rank Provided: testRank - Invalid char: A, Z', $exception->getMessage());
        self::assertSame(0, $exception->getCode());
    }
}
