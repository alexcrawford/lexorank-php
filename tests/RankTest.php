<?php

namespace AlexCrawford\LexoRank\Tests;

use AlexCrawford\LexoRank\Rank;
use PHPUnit\Framework\TestCase;

class RankTest extends TestCase
{
    public function testSuccessEmptyPrevEmptyNext()
    {
        $rank = (new Rank('', ''))->get();
        $this->assertSame('U', $rank);
    }

    public function testSuccessEmptyPrev()
    {
        $rank = (new Rank('', '2'))->get();
        $this->assertSame('1', $rank);
    }

    public function testSuccessEmptyNext()
    {
        $rank = (new Rank('x', ''))->get();
        $this->assertSame('y', $rank);
    }

    public function testSuccessNewDigit()
    {
        $rank = (new Rank('aaaa', 'aaab'))->get();
        $this->assertSame('aaaaU', $rank);
    }

    public function testSuccessMidValue()
    {
        $rank = (new Rank('aaaa', 'aaac'))->get();
        $this->assertSame('aaab', $rank);
    }

    public function testSuccessNewDigitMidValue()
    {
        $rank = (new Rank('az', 'b'))->get();
        $this->assertSame('azU', $rank);
    }

}