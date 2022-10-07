<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\MaxRankLength;
use PHPUnit\Framework\TestCase;

/** @covers \AlexCrawford\LexoRank\Exception\MaxRankLength */
class MaxRankLengthTest extends TestCase
{
    public function testForInputRankWithInvalidChars(): void
    {
        $this->expectException(MaxRankLength::class);
        $this->expectExceptionMessage('The length of Rank provided is too long. Rank Provided: testRank - Rank Length: 8 - Max length: 7');
        $this->expectExceptionCode(0);

        throw MaxRankLength::forInputRank('testRank', 7);
    }
}
