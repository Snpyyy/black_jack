<?php

namespace BlackJack\Tests;

require_once(__DIR__ . '/../lib/game_player/Dealer.php');
require_once(__DIR__ . '/../lib/Deck.php');
require_once(__DIR__ . '/../lib/TotalScore.php');
require_once(__DIR__ . '/../lib/Display.php');

use PHPUnit\Framework\TestCase;
use BlackJack\GamePlayer\Dealer;
use BlackJack\Deck;
use BlackJack\TotalScore;
use BlackJack\Display;

class DealerTest extends TestCase
{
    public function testDrawCard()
    {
        $dealer = new Dealer('ディーラー');
        $deck = new Deck();

        $this->assertSame(2, count($dealer->drawCard($deck, 2)));
        $this->assertSame(3, count($dealer->drawCard($deck, 1)));
    }

    public function testFirstDrawCardView()
    {
        $dealer = new Dealer('ディーラー');
        $display = new Display();

        $screen = <<<EOD
        ディーラーの引いたカードはダイヤのQです。
        ディーラーの引いた2枚目のカードはわかりません。

        EOD;

        $this->expectOutputString($screen);
        $dealer->firstDrawCardView($display, ['DQ', 'D2']);
    }
}
