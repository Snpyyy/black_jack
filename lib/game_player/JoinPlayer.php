<?php

namespace BlackJack\GamePlayer;

require_once(__DIR__ . '/../Deck.php');
require_once(__DIR__ . '/../TotalScore.php');
require_once(__DIR__ . '/../Display.php');

use BlackJack\Deck;
use BlackJack\TotalScore;
use BlackJack\Display;

class JoinPlayer
{
    /**
     * @var GamePlayer $player
     */
    private $player;

    public function __construct(GamePlayer $player)
    {
        $this->player = $player;
    }


    /**
     * @param Deck $deck
     * @param int $drawCount
     * @return array<string>
     */
    public function drawCard(Deck $deck, int $drawCount): array
    {
        return $this->player->drawCard($deck, $drawCount);
    }


    /**
     * @param TotalScore $totalScore
     * @return int
     */
    public function getScore(TotalScore $totalScore)
    {
        return $this->player->getScore($totalScore);
    }


    /**
     * @param int $totalScore
     * @return bool
     */
    public function checkScore(int $totalScore): bool
    {
        return $this->player->checkScore($totalScore);
    }

    /**
     * @param Display $display
     * @param array<string> $drawCards
     */
    public function firstDrawCardView(Display $display, array $drawCards): void
    {
        $this->player->firstDrawCardView($display, $drawCards);
    }


    /**
     * @param Display $display
     * @param int $totalScore
     */
    public function isDrawCardView(Display $display, int $totalScore): void
    {
        $this->player->isDrawCardView($display, $totalScore);
    }


    /**
     * @param Display $display
     */
    public function totalScoreView(Display $display): void
    {
        $this->player->totalScoreView($display);
    }


    /**
     * @param Display $display
     */
    public function getDrawCardView(Display $display): void
    {
        $this->player->getDrawCardView($display);
    }
}
