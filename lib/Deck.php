<?php

namespace BlackJack;

require_once('Card.php');

use BlackJack\Card;

class Deck
{
    /**
     * @var array<string,string>
     */
    private array $deck = [];

    public function __construct()
    {
        foreach (array_keys(Card::CARD_SUITS) as $suit) {
            foreach (array_keys(Card::CARD_NUMBERS_SCORE) as $num) {
                $this->deck[] = $suit . $num;
            }
        }
    }

    /**
     * @param int $drawCount
     * @return array<string> $card
     */
    public function drawCard(int $drawCount): array
    {
        $card = [];
        $randKeys = array_rand($this->deck, $drawCount);
        foreach ((array)$randKeys as $randKye) {
            $card[] = $this->deck[$randKye];
            unset($this->deck[$randKye]);
        }
        return $card;
    }
}
