<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\MaxRankLength;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function str_repeat;

#[CoversClass(MaxRankLength::class)]
final class MaxRankLengthTest extends TestCase
{
    public function testForInputRankWithInvalidChars(): void
    {
        $exception = MaxRankLength::forInputRank('testRank', 7);

        self::assertSame('The length of Rank provided is too long. Rank Provided: testRank - Rank Length: 8 - Max length: 7', $exception->getMessage());
        self::assertSame(0, $exception->getCode());
    }

    public function testLongRankIsShortenedInMessage(): void
    {
        $exception = MaxRankLength::forInputRank(str_repeat('a', 2000), 1024);

        self::assertSame('The length of Rank provided is too long. Rank Provided: ' . str_repeat('a', 50) . '... - Rank Length: 2000 - Max length: 1024', $exception->getMessage());
    }
}
