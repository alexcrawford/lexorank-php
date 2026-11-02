<?php

declare(strict_types=1);

namespace AlexCrawford\LexoRank\Exception;

use function addcslashes;
use function strlen;
use function substr;

/** @internal */
final class RankExcerpt
{
    public const MAX_LENGTH = 50;

    public static function of(string $rank): string
    {
        if (strlen($rank) > self::MAX_LENGTH) {
            return addcslashes(substr($rank, 0, self::MAX_LENGTH), "\0..\37\177..\377") . '...';
        }

        return addcslashes($rank, "\0..\37\177..\377");
    }
}
