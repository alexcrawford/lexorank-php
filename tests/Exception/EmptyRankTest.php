<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\EmptyRank;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EmptyRank::class)]
final class EmptyRankTest extends TestCase
{
    public function testCreate(): void
    {
        $exception = EmptyRank::create();

        self::assertSame('Rank provided is empty.', $exception->getMessage());
        self::assertSame(0, $exception->getCode());
    }
}
