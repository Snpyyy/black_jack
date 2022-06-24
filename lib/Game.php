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

    public const FIRST_DRAW_CARD_COUNT = 2;
    public function __construct(int $playerCount)
    {
        $this->playerCount = $playerCount;
    }

    public function start(): void
    {
        $deck = new Deck();
        $display = new Display();
        $user = new User('あなた');
        $dealer = new Dealer('ディーラー');
        // $cpu = new ComputerPlayer();

        foreach ([$user, $dealer] as $player) {
            $joinPlayer = new JoinPlayer($player);
            $drawCards = $joinPlayer->drawCard($deck, self::FIRST_DRAW_CARD_COUNT);
            $joinPlayer->firstDrawCardView($display, $drawCards);
        }

        $joinPlayer = new JoinPlayer($user);
        $totalScore = new TotalScore();
        $this->userScore = $joinPlayer->getScore($totalScore);

        while ($joinPlayer->checkScore($this->userScore)) {
            $joinPlayer->isDrawCardView($display, $this->userScore);
            $stdin = trim(fgets(STDIN));
            if ($stdin === 'Y') {
                $joinPlayer->drawCard($deck, 1);
                $joinPlayer->getDrawCardView($display);
                $this->userScore = $joinPlayer->getScore($totalScore);
            } elseif ($stdin === 'N') {
                break;
            } else {
                $display->generate('YかNで入力してください');
            }
        }

        $joinPlayer = new JoinPlayer($dealer);
        $dealer->secondDrawCardView($display);
        $this->dealerScore = $joinPlayer->getScore($totalScore);
        while ($joinPlayer->checkScore($this->dealerScore)) {
            $joinPlayer->totalScoreView($display);
            $joinPlayer->drawCard($deck, 1);
            $joinPlayer->getDrawCardView($display);
            $this->dealerScore = $joinPlayer->getScore($totalScore);
        }

        foreach ([$user, $dealer] as $player) {
            $joinPlayer = new JoinPlayer($player);
            $joinPlayer->totalScoreView($display);
        }

        $display->judgeView($this->userScore, $this->dealerScore);
    }
}
