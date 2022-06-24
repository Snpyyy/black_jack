<?php

namespace BlackJack\Tests;

require_once(__DIR__ . '/../lib/Deck.php');

use PHPUnit\Framework\TestCase;
use BlackJack\Deck;

class DeckTest extends TestCase
{
    public function testDrawCard()
    {
        $deck = new Deck();
        $this->assertSame(2, count($deck->drawCard(2)));
    }
}
