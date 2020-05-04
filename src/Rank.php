<?php

namespace AlexCrawford\LexoRank;

use phpDocumentor\Reflection\Types\Integer;

class Rank
{

    public const MIN_CHAR = '0';
    public const MAX_CHAR = 'z';

    private $prev;
    private $next;

    /**
     * Rank constructor.
     */
    public function __construct(string $prev, string $next)
    {
        $this->setPrev($prev);
        $this->setNext($next);
    }

    private function setPrev(string $prev)
    {
        $this->prev = $prev === '' ? self::MIN_CHAR : $prev;
    }

    private function setNext(string $next)
    {
        $this->next = $next === '' ? self::MAX_CHAR : $next;
    }

    public function get()
    {
        $rank = '';
        $i = 0;

        while (true) {
            $prevChar = $this->getChar($this->prev, $i, self::MIN_CHAR);
            $nextChar = $this->getChar($this->next, $i, self::MAX_CHAR);

            if ($prevChar === $nextChar) {
                $rank .= $prevChar;
                $i++;
                continue;
            }

            $midChar = $this->mid($prevChar, $nextChar);
            if (in_array($midChar, [$prevChar, $nextChar])) {
                $rank .= $prevChar;
                $i++;
                continue;
            }

//            var_dump($midChar);
//            die;

            $rank .= $midChar;
            break;
        }

        return $rank;
    }

    private function getChar(string $s, int $i, string $defaultChar)
    {
         return $s[$i] ?? $defaultChar;
    }

    private function mid(string $prev, string $next)
    {
        return chr((ord($prev) + ord($next)) / 2);
    }


}