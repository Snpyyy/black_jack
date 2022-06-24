<?php

namespace BlackJack\Tests;

require_once(__DIR__ . '/../lib/Display.php');

use PHPUnit\Framework\TestCase;
use BlackJack\Display;

class DisplayTest extends TestCase
{
    public function testFirstDrawCardView()
    {
        $display = new Display();
        $screen = <<<EOD
        あなたの引いたカードはハートの7です。
        あなたの引いたカードはクラブの8です。

        EOD;

        $this->expectOutputString($screen);
        $display->firstDrawCardView(['H7', 'K8'], 'あなた');
    }

    public function testIsDrawCardView()
    {
        $display = new Display();
        $screen = <<<EOD
        あなたの現在の得点は15です。カードを引きますか？(Y/N)

        EOD;

        $this->expectOutputString($screen);
        $display->isDrawCardView(15, 'あなた');
    }

    public function testSecondDrawCardView()
    {
        $display = new Display();
        $screen = 'ディーラーの引いた2枚目のカードはダイヤの2でした。' . PHP_EOL;

        $this->expectOutputString($screen);
        $display->secondDrawCardView(['DQ', 'D2'], 'ディーラー');
    }

    public function testTotalScoreView()
    {
        $display = new Display();
        $screen = 'ディーラーの現在の得点は15です。' . PHP_EOL;

        $this->expectOutputString($screen);
        $display->totalScoreView(15, 'ディーラー');
    }

    public function testJudgeView()
    {
        $display = new Display();
        $screen = 'あなたの勝ちです。' . PHP_EOL;

        $this->expectOutputString($screen);
        $display->judgeView(21,1);
    }

    public function testGetDrawCardView()
    {
        $display = new Display();
        $screen = 'あなたの引いたカードはスペードの5です。' . PHP_EOL;

        $this->expectOutputString($screen);
        $display->getDrawCardView('S5', 'あなた');
    }

    public function testGenerate()
    {
        $display = new Display();
        $screen = 'aiueo' . PHP_EOL;
        $this->expectOutputString($screen);
        $display->generate('aiueo');
    }
}
