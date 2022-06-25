<?php

namespace BlackJack;

class Card
{
    public const CARD_SUITS = [
        'K' => 'クラブ',
        'D' => 'ダイヤ',
        'H' => 'ハート',
        'S' => 'スペード'
    ];
    public const CARD_NUMBERS_SCORE = [
        'A' => 11,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10,
    ];
    private string $suit;
    private string $num;
    public function __construct(string $suit, string $num)
    {
        $this->suit = $suit;
        $this->num = $num;
    }

    public function getSuit(): string
    {
        return self::CARD_SUITS[$this->suit];
    }

    public function getNum(): string
    {
        return $this->num;
    }

    public function getNumScore(): int
    {
        return self::CARD_NUMBERS_SCORE[$this->num];
    }
}
