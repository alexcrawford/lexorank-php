<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Tests;

use AlexCrawford\LexoRank\Exception\EmptyRank;
use AlexCrawford\LexoRank\Exception\InvalidChars;
use AlexCrawford\LexoRank\Exception\LastCharCantBeEqualToMinChar;
use AlexCrawford\LexoRank\Exception\MaxRankLength;
use AlexCrawford\LexoRank\Exception\PrevGreaterThanOrEquals;
use AlexCrawford\LexoRank\Rank;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function str_repeat;

#[CoversClass(Rank::class)]
final class RankTest extends TestCase
{
    public function testGenerateANewRankFromString(): void
    {
        $rank = Rank::fromString('AA01');
        self::assertSame('AA01', $rank->get());
    }

    /**
     * @param non-empty-string $prev
     * @param non-empty-string $next
     * @param non-empty-string $expected
     */
    #[DataProvider('betweenProvider')]
    public function testBetween(string $prev, string $next, string $expected): void
    {
        $rank = Rank::betweenRanks(
            Rank::fromString($prev),
            Rank::fromString($next),
        );
        self::assertSame($expected, $rank->get());
    }

    /**
     * @return array<array-key, array{non-empty-string, non-empty-string, non-empty-string}>
     */
    public static function betweenProvider(): array
    {
        return [
            'NewDigit' => ['aaaa', 'aaab', 'aaaaU'],
            'MidValue' => ['aaaa', 'aaac', 'aaab'],
            'NewDigitMidValue' => ['az', 'b', 'azU'],
            'NewDigitMidValueSpecialCase' => ['amz', 'ana', 'amzU'],
            ['baba', 'fgfg', 'd'],
            ['1', '2', '1U'],
            ['ya', 'ya5', 'ya2'],
            ['ya', 'yc5', 'yb'],
        ];
    }

    /**
     * @param non-empty-string $prev
     * @param non-empty-string $expected
     */
    #[DataProvider('afterProvider')]
    public function testAfter(string $prev, string $expected): void
    {
        $rank = Rank::after(
            Rank::fromString($prev),
        );
        self::assertSame($expected, $rank->get());
    }

    /**
     * @return list<array{non-empty-string, non-empty-string}>
     */
    public static function afterProvider(): array
    {
        return [
            ['aaaa', 'aaab'],
            ['aaaz', 'aaaz1'],
            ['1', '2'],
            ['y', 'y1'],
            ['x', 'y'],
        ];
    }

    /**
     * @param non-empty-string $next
     * @param non-empty-string $expected
     */
    #[DataProvider('beforeProvider')]
    public function testBefore(string $next, string $expected): void
    {
        $rank = Rank::before(
            Rank::fromString($next),
        );
        self::assertSame($expected, $rank->get());
    }

    /**
     * @return list<array{non-empty-string, non-empty-string}>
     */
    public static function beforeProvider(): array
    {
        return [
            ['2', '1'],
            ['acab', 'acaa'],
            ['aaa1', 'aaa0y'],
            ['2', '1'],
            ['y1', 'y0y'],
        ];
    }

    public function testForEmptySequence(): void
    {
        self::assertSame('U', Rank::forEmptySequence()->get());
    }

    public function testEmptyRank(): void
    {
        $this->expectExceptionObject(EmptyRank::create());
        Rank::fromString('');
    }

    public function testInvalidChars(): void
    {
        $this->expectExceptionObject(InvalidChars::forInputRankWithInvalidChars('0/0z*z0+0z{z', ['/', '*', '+', '{']));
        Rank::fromString('0/0z*z0+0z{z');
    }

    public function testMaxRankLength(): void
    {
        $base = str_repeat('y', Rank::MAX_RANK_LEN + 1);

        $this->expectException(MaxRankLength::class);
        Rank::fromString($base);
    }

    public function testLastCharCantBeEqualToMinChar(): void
    {
        $this->expectExceptionObject(LastCharCantBeEqualToMinChar::forRank('UUU0', Rank::MIN_CHAR));
        Rank::fromString('UUU0');
    }

    public function testBetweenMaxRankLength(): void
    {
        $base = str_repeat('y', Rank::MAX_RANK_LEN - 1);

        $prev = $base . 'x';
        $next = $base . 'y';

        $this->expectExceptionObject(MaxRankLength::forInputRank($prev . 'U', Rank::MAX_RANK_LEN));
        Rank::betweenRanks(
            Rank::fromString($prev),
            Rank::fromString($next),
        );
    }

    public function testPrevGreaterThanNext(): void
    {
        $this->expectException(PrevGreaterThanOrEquals::class);
        Rank::betweenRanks(
            Rank::fromString('Z'),
            Rank::fromString('A'),
        );
    }

    public function testPrevEqualsToNext(): void
    {
        $this->expectException(PrevGreaterThanOrEquals::class);
        Rank::betweenRanks(
            Rank::fromString('D'),
            Rank::fromString('D'),
        );
    }
}
