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

        $this->assertSame(21, $totalScore->getScore(['HJ', 'D10', 'KA']));
        $this->assertSame(21, $totalScore->getScore(['HA', 'DA', 'SA', 'K3', 'S5']));
        $this->assertSame(20, $totalScore->getScore(['HK', 'DQ']));
    }
}
