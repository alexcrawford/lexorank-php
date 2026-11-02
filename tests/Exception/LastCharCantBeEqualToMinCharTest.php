<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\LastCharCantBeEqualToMinChar;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(LastCharCantBeEqualToMinChar::class)]
final class LastCharCantBeEqualToMinCharTest extends TestCase
{
    public function testForInputRankWithInvalidChars(): void
    {
        $exception = LastCharCantBeEqualToMinChar::forRank('testRank0', '0');

        self::assertSame('The last char of the rank (testRank0) can\'t be equal to the min char (0).', $exception->getMessage());
        self::assertSame(0, $exception->getCode());
    }
}
