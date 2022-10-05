<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\PrevGreaterThanOrEquals;
use AlexCrawford\LexoRank\Rank;
use PHPUnit\Framework\TestCase;

/** @covers \AlexCrawford\LexoRank\Exception\PrevGreaterThanOrEquals */
class PrevGreaterThanOrEqualTest extends TestCase
{
    public function testBetweenRanks(): void
    {
        $this->expectException(PrevGreaterThanOrEquals::class);
        $this->expectExceptionMessage('Previous Rank (Z) is greater than or equals to Next (A)');
        $this->expectExceptionCode(0);

        throw PrevGreaterThanOrEquals::betweenRanks(
            Rank::fromString('Z'),
            Rank::fromString('A'),
        );
    }
}
