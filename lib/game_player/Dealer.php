<?php

namespace BlackJack\GamePlayer;

require_once('GamePlayer.php');
require_once(__DIR__ . '/../Deck.php');
require_once(__DIR__ . '/../TotalScore.php');
require_once(__DIR__ . '/../Display.php');

use BlackJack\GamePlayer\GamePlayer;
use BlackJack\Deck;
use BlackJack\TotalScore;
use BlackJack\Display;

class Dealer extends GamePlayer
{
    /**
     * @var array<string> $hand
     */
    private $hand = [];

    /**
     * @var int $score
     */
    private $score;

    private const GET_END_CARD_SCORE = 17;

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
     * @return int $score
     */
    public function getScore(TotalScore $totalScore): int
    {
        $this->score = $totalScore->getScore($this->hand);
        return $this->score;
    }

    /**
     * @param int $totalScore
     * @return bool
     */
    public function checkScore(int $totalScore): bool
    {
        if (self::GET_END_CARD_SCORE < $totalScore) {
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
    public function secondDrawCardView(Display $display): void
    {
        $display->secondDrawCardView($this->hand, $this->name);
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
