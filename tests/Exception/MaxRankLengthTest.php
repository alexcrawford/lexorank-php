<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\MaxRankLength;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MaxRankLength::class)]
final class MaxRankLengthTest extends TestCase
{
    public function testForInputRankWithInvalidChars(): void
    {
        $exception = MaxRankLength::forInputRank('testRank', 7);

        self::assertSame('The length of Rank provided is too long. Rank Provided: testRank - Rank Length: 8 - Max length: 7', $exception->getMessage());
        self::assertSame(0, $exception->getCode());
    }
}
