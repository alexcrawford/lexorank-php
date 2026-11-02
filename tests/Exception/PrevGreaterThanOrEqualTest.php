<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\PrevGreaterThanOrEquals;
use AlexCrawford\LexoRank\Rank;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PrevGreaterThanOrEquals::class)]
final class PrevGreaterThanOrEqualTest extends TestCase
{
    public function testBetweenRanks(): void
    {
        $exception = PrevGreaterThanOrEquals::betweenRanks(
            Rank::fromString('Z'),
            Rank::fromString('A'),
        );

        self::assertSame('Previous Rank (Z) is greater than or equals to Next (A)', $exception->getMessage());
        self::assertSame(0, $exception->getCode());
    }
}
