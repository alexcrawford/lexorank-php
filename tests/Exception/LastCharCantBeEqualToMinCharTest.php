<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\LastCharCantBeEqualToMinChar;
use PHPUnit\Framework\TestCase;

/** @covers \AlexCrawford\LexoRank\Exception\LastCharCantBeEqualToMinChar */
class LastCharCantBeEqualToMinCharTest extends TestCase
{
    public function testForInputRankWithInvalidChars(): void
    {
        $this->expectException(LastCharCantBeEqualToMinChar::class);
        $this->expectExceptionMessage('The last char of the rank (testRank0) can\'t be equal to the min char (0).');
        $this->expectExceptionCode(0);

        throw LastCharCantBeEqualToMinChar::forRank('testRank0', '0');
    }
}
