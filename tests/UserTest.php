<?php

namespace BlackJack\Tests;

require_once(__DIR__ . '/../lib/game_player/User.php');
require_once(__DIR__ . '/../lib/Deck.php');
require_once(__DIR__ . '/../lib/TotalScore.php');
require_once(__DIR__ . '/../lib/Display.php');

use PHPUnit\Framework\TestCase;
use BlackJack\GamePlayer\User;
use BlackJack\Deck;
use BlackJack\TotalScore;
use BlackJack\Display;

class UserTest extends TestCase
{
    public function testDrawCard()
    {
        $user = new User('あなた');
        $deck = new Deck();

        $this->assertSame(2, count($user->drawCard($deck, 2)));
        $this->assertSame(3, count($user->drawCard($deck, 1)));
    }

    // public function testGetScore()
    // {}

    public function testCheckScore()
    {
        $user = new User('あなた');
        $this->assertTrue($user->checkScore(20));
        $this->assertTrue($user->checkScore(21));
        $this->assertFalse($user->checkScore(22));
    }

    public function testFirstDrawCardView()
    {
        $user = new User('あなた');
        $display = new Display();

        $screen = <<<EOD
        あなたの引いたカードはハートの7です。
        あなたの引いたカードはクラブの8です。

        EOD;

        $this->expectOutputString($screen);
        $user->firstDrawCardView($display, ['H7', 'K8']);
    }
}
