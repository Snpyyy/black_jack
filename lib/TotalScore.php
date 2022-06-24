<?php

namespace BlackJack;

require_once('Card.php');

use BlackJack\Card;

class TotalScore
{
    /**
     * @var int $score
     */
    private $score = 0;

    /**
     * @param array<string> $handCards
     */
    public function getScore(array $handCards): int
    {
        $this->score = 0;
        foreach ($handCards as $handCard) {
            $card = new Card(substr($handCard, 0, 1), substr($handCard, 1, strlen($handCard) - 1));
            $this->score += $card->getNumScore();
        }

        return $this->score;
    }
}
