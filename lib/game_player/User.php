<?php

namespace BlackJack\GamePlayer;

require_once('GamePlayer.php');
require_once(__DIR__ . '/../Deck.php');
require_once(__DIR__ . '/../TotalScore.php');

use BlackJack\GamePlayer\GamePlayer;
use BlackJack\Deck;
use BlackJack\Display;
use BlackJack\TotalScore;

class User extends GamePlayer
{
    /**
     * @var array<string> $hand
     */
    private $hand = [];

    /**
     * @var int $score
     */
    private $score;

    /**
     * @param Deck $deck
     * @param int $drawCount
     * @return array<string> $hand
     */
    public function drawCard(Deck $deck, int $drawCount): array
    {
        $this->hand = array_merge($this->hand, $deck->drawCard($drawCount));
        return $this->hand;
    }

    /**
     * @param TotalScore $totalScore
     * @return int $totalScore
     */
    public function getScore(TotalScore $totalScore): int
    {
        $this->score = $totalScore->getScore($this->hand);
        return $this->score;
    }

    /**
     * @param int $playerScore
     * @return bool
     */
    public function checkScore(int $playerScore): bool
    {
        if (21 < $playerScore) {
            return false;
        }

        return true;
    }

    /**
     * @param Display $display
     * @param array<string> $drawCards
     */
    public function firstDrawCardView(Display $display, array $drawCards): void
    {
        $display->firstDrawCardView($drawCards, $this->name);
    }

    /**
     * @param Display $display
     * @param int $totalScore
     */
    public function isDrawCardView(Display $display, int $totalScore): void
    {
        $display->isDrawCardView($totalScore, $this->name);
    }

    /**
     * @param Display $display
     */
    public function totalScoreView(Display $display): void
    {
        $display->totalScoreView($this->score, $this->name);
    }

    /**
     * @param Display $display
     */
    public function getDrawCardView(Display $display): void
    {
        $display->getDrawCardView(end($this->hand), $this->name);
    }
}
