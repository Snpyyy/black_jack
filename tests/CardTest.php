<?php

namespace BlackJack\Tests;

require_once(__DIR__ . '/../lib/Card.php');

use PHPUnit\Framework\TestCase;
use BlackJack\Card;

class CardTest extends TestCase
{
    public function testGetCard()
    {
        $card = new Card('H', '7');
        $this->assertSame('ハート', $card->getSuit());
        $this->assertSame(7, $card->getNumScore());
    }
}
