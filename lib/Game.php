<?php

namespace BlackJack;

require_once('Deck.php');
require_once('TotalScore.php');
require_once('Display.php');
require_once(__DIR__ . '/game_player/User.php');
// require_once(__DIR__ . '/game_player/ComputerPlayer.php');
require_once(__DIR__ . '/game_player/Dealer.php');
require_once(__DIR__ . '/game_player/JoinPlayer.php');

use BlackJack\Deck;
use BlackJack\TotalScore;
use BlackJack\Display;
use BlackJack\GamePlayer\User;
// use BlackJack\GamePlayer\ComputerPlayer;
use BlackJack\GamePlayer\Dealer;
use BlackJack\GamePlayer\JoinPlayer;

class Game
{
    /**
     * @var User $user
     */
    public $user;

    /**
     * @var Dealer $dealer
     */
    public $dealer;

    /**
     * @var int $playerCount
     */
    public $playerCount;

    /**
     * @var int $userScore
     */
    public $userScore = 0;

    /**
     * @var int $dealerScore
     */
    public $dealerScore = 0;

    /**
     * @var int $playerScore
     */
    // public $playerScore = 0;

    /**
     * @var Deck $deck
     */
    public $deck;

    /**
     * @var Display $display
     */
    public $display;

    /**
     * @var TotalScore $totalScore
     */
    public $totalScore;

    public const FIRST_DRAW_CARD_COUNT = 2;
    public function __construct(int $playerCount)
    {
        $this->playerCount = $playerCount;
    }

    public function start(): void
    {
        $this->deck = new Deck();
        $this->display = new Display();
        $this->totalScore = new TotalScore();
        $this->user = new User('あなた');
        $this->dealer = new Dealer('ディーラー');
        // $cpu = new ComputerPlayer();

        foreach ([$this->user, $this->dealer] as $player) {
            $joinPlayer = new JoinPlayer($player);
            $drawCards = $joinPlayer->drawCard($this->deck, self::FIRST_DRAW_CARD_COUNT);
            $joinPlayer->firstDrawCardView($this->display, $drawCards);
        }

        $this->userTurn();
        $this->dealerTurn();

        foreach ([$this->user, $this->dealer] as $player) {
            $joinPlayer = new JoinPlayer($player);
            $joinPlayer->totalScoreView($this->display);
        }

        $this->display->judgeView($this->userScore, $this->dealerScore);
    }

    private function userTurn(): void
    {
        $joinPlayer = new JoinPlayer($this->user);
        $this->userScore = $joinPlayer->getScore($this->totalScore);

        while ($joinPlayer->checkScore($this->userScore)) {
            $joinPlayer->isDrawCardView($this->display, $this->userScore);
            $stdin = trim(fgets(STDIN));
            if ($stdin === 'Y') {
                $joinPlayer->drawCard($this->deck, 1);
                $joinPlayer->getDrawCardView($this->display);
                $this->userScore = $joinPlayer->getScore($this->totalScore);
            } elseif ($stdin === 'N') {
                break;
            } else {
                $this->display->generate('YかNで入力してください');
            }
        }
    }

    private function dealerTurn(): void
    {
        $joinPlayer = new JoinPlayer($this->dealer);
        $this->dealer->secondDrawCardView($this->display);
        $this->dealerScore = $joinPlayer->getScore($this->totalScore);
        while ($joinPlayer->checkScore($this->dealerScore)) {
            $joinPlayer->totalScoreView($this->display);
            $joinPlayer->drawCard($this->deck, 1);
            $joinPlayer->getDrawCardView($this->display);
            $this->dealerScore = $joinPlayer->getScore($this->totalScore);
        }
    }
}
