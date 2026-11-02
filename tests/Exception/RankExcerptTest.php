<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests\Exception;

use AlexCrawford\LexoRank\Exception\RankExcerpt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function str_repeat;

#[CoversClass(RankExcerpt::class)]
final class RankExcerptTest extends TestCase
{
    #[DataProvider('excerptProvider')]
    public function testOf(string $rank, string $expected): void
    {
        self::assertSame($expected, RankExcerpt::of($rank));
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function excerptProvider(): array
    {
        return [
            'Printable' => ['aZ09:{', 'aZ09:{'],
            'ControlChars' => ["ab\ncd\t\0", 'ab\ncd\t\000'],
            'NonAscii' => ["\xC3\xA9", '\303\251'],
            'AtMaxLength' => [str_repeat('a', 50), str_repeat('a', 50)],
            'OverMaxLength' => [str_repeat('a', 51), str_repeat('a', 50) . '...'],
        ];
    }
}
