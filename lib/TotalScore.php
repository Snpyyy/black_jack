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

    private const MAX_ACE_SCORE = 11;
    private const MIN_ACE_SCORE = 1;

    /**
     * @param array<string> $handCards
     */
    public function getScore(array $handCards): int
    {
        $hand = [];
        $this->score = 0;
        foreach ($handCards as $handCard) {
            $card = new Card(substr($handCard, 0, 1), substr($handCard, 1, strlen($handCard) - 1));
            $hand[] = $card->getNum();
            $this->score += $card->getNumScore();
        }

        $aceCount = count(array_keys($hand, 'A'));
        for ($i = 0; $i < $aceCount; $i++) {
            if (in_array('A', $hand) && $this->score > 21) {
                $this->score -= self::MAX_ACE_SCORE;
                $this->score += self::MIN_ACE_SCORE;
            }
        }
        return $this->score;
    }
}
