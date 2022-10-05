<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\InvalidChars;
use PHPUnit\Framework\TestCase;

/** @covers \AlexCrawford\LexoRank\Exception\InvalidChars */
class InvalidCharsTest extends TestCase
{
    public function testForInputRankWithInvalidChars(): void
    {
        $this->expectException(InvalidChars::class);
        $this->expectExceptionMessage('Rank provided contains an invalid Char. Rank Provided: testRank - Invalid char: A, Z');
        $this->expectExceptionCode(0);

        throw InvalidChars::forInputRankWithInvalidChars('testRank', ['A', 'Z']);
    }
}
