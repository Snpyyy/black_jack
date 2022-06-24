<?php

namespace BlackJack\GamePlayer;

require_once(__DIR__ . '/../Deck.php');
require_once(__DIR__ . '/../TotalScore.php');

use BlackJack\Deck;
use BlackJack\Display;
use BlackJack\TotalScore;

abstract class GamePlayer
{
    /**
     * @var string $name
     */
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param Deck $deck
     * @param int $drawCount
     * @return array<string>
     */
    abstract public function drawCard(Deck $deck, int $drawCount): array;


    /**
     * @param TotalScore $totalScore
     * @return int
     */
    abstract public function getScore(TotalScore $totalScore): int;


    /**
     * @param int $playerScore
     * @return bool
     */
    abstract public function checkScore(int $playerScore): bool;


    /**
     * @param Display $display
     * @param array<string> $drawCards
     */
    abstract public function firstDrawCardView(Display $display, array $drawCards): void;


    /**
     * @param Display $display
     * @param int $totalScore
     */
    abstract public function isDrawCardView(Display $display, int $totalScore): void;


    /**
     * @param Display $display
     */
    abstract public function totalScoreView(Display $display): void;


    /**
     * @param Display $display
     */
    abstract public function getDrawCardView(Display $display): void;
}
