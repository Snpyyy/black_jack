<?php

namespace BlackJack\Tests;

require_once(__DIR__ . '/../lib/TotalScore.php');

use PHPUnit\Framework\TestCase;
use BlackJack\TotalScore;

class TotalScoreTest extends TestCase
{
    public function testGetScore()
    {
        $totalScore = new TotalScore();

        $this->assertSame(20, $totalScore->getScore(['HJ', 'D10']));
        $this->assertSame(6, $totalScore->getScore(['HA', 'D5']));
        $this->assertSame(20, $totalScore->getScore(['HK', 'DQ']));
    }
}
