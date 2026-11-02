# lexorank

> A simple PHP implementation of [xissy/lexorank](https://github.com/xissy/lexorank)

LexoRank is a ranking system introduced by Atlassian JIRA.
  * <https://www.youtube.com/watch?v=OjQv9xMoFbg>

## Background
What is the best representation of an ordered list in a database?
With a dumb order number based ranking system, re-ordering a row of a
list may require updating all rows of the list in a transaction,
which is O(n).
  * <https://stackoverflow.com/questions/9536262/best-representation-of-an-ordered-list-in-a-database/49956113>
  * <https://softwareengineering.stackexchange.com/questions/195308/storing-a-re-orderable-list-in-a-database>

LexoRank makes it O(1). All you need to do is updating the re-ordered
row's order field.

## Installation

```
composer require alexcrawford/lexorank-php
```

Requires PHP 8.1 or later.

## Usage

```php
use AlexCrawford\LexoRank\Rank;

$first = Rank::forEmptySequence();           // 'U'
$last = Rank::after($first);                 // 'V'
$top = Rank::before($first);                 // 'T'
$middle = Rank::betweenRanks($first, $last); // 'UU'

$rank = Rank::fromString($row->sort);
$rank->get(); // the string to store
```

`betweenRanks()` throws `PrevGreaterThanOrEquals` if the first rank does not sort before the second.

## Storing ranks

Ranks are made of the ASCII characters `0` to `z`, which includes upper case, lower case and a few punctuation characters. Order by the column with a binary or case-sensitive collation, or the database will sort `a` and `A` together and the order will be wrong. In MySQL, use `ascii_bin` or `utf8mb4_bin`.

A rank can be up to 1024 characters (`Rank::MAX_RANK_LEN`), and anything longer throws `MaxRankLength`. Ranks get longer as you keep inserting at the same place, for example appending to the end of one list many thousands of times. The library doesn't rebalance a list, so if that happens, rewrite the list's ranks from `forEmptySequence()` onwards.

## Development

```
composer install
vendor/bin/phpunit
vendor/bin/psalm
vendor/bin/phpcs
```

CI also runs [Infection](https://infection.github.io/) mutation tests.
