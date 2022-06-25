<?php

namespace BlackJack;

require_once('Card.php');

use BlackJack\Card;

class Display
{
    /**
     * @param array<string> $drawCards
     * @param string $name
     */
    public function firstDrawCardView(array $drawCards, string $name): void
    {
        $card = [];
        foreach ((array)$drawCards as $drawCard) {
            $card[] = new Card(substr($drawCard, 0, 1), substr($drawCard, 1, strlen($drawCard) - 1));
        }

        if ($name === 'ディーラー') {
            $msg = <<<EOD
            {$name}の引いたカードは{$card[0]->getSuit()}の{$card[0]->GetNum()}です。
            {$name}の引いた2枚目のカードはわかりません。
            EOD;
        } else {
            $msg = <<<EOD
            {$name}の引いたカードは{$card[0]->getSuit()}の{$card[0]->getNum()}です。
            {$name}の引いたカードは{$card[1]->getSuit()}の{$card[1]->getNum()}です。
            EOD;
        }
        $this->generate($msg);
    }

    /**
     * @param int $totalScore
     * @param string $name
     */
    public function isDrawCardView(int $totalScore, string $name): void
    {
        $msg = "{$name}の現在の得点は{$totalScore}です。カードを引きますか？(Y/N)";
        $this->generate($msg);
    }

    /**
     * @param array<string> $hand
     * @param string $name
     */
    public function secondDrawCardView(array $hand, string $name): void
    {
        $card = new Card(substr($hand[1], 0, 1), substr($hand[1], 1, strlen($hand[1]) - 1));
        $msg = "{$name}の引いた2枚目のカードは{$card->getSuit()}の{$card->getNum()}でした。";
        $this->generate($msg);
    }

    /**
     * @param int $totalScore
     * @param string $name
     */
    public function totalScoreView(int $totalScore, string $name): void
    {
        $msg = "{$name}の現在の得点は{$totalScore}です。";
        $this->generate($msg);
    }

    /**
     * @param int $userScore
     * @param int $dealerScore
     */
    public function judgeView(int $userScore, int $dealerScore): void
    {
        $msg = '';
        $overScore = $userScore > 21 && $dealerScore > 21;
        $sameScore = $userScore === $dealerScore;
        if ($overScore || $sameScore) {
            $msg  = '勝負は引き分けです。';
        } elseif ($userScore > 21 || $dealerScore > $userScore) {
            $msg = 'ディーラーの勝ちです。';
        } else {
            $msg = 'あなたの勝ちです。';
        }

        $this->generate($msg);
    }

    /**
     * @param string $drawCard
     * @param string $name
     */
    public function getDrawCardView(string $drawCard, string $name): void
    {
        $card = new Card(substr($drawCard, 0, 1), substr($drawCard, 1, strlen($drawCard) - 1));
        $msg = "{$name}の引いたカードは{$card->getSuit()}の{$card->getNum()}です。";

        $this->generate($msg);
    }

    /**
     * @param string $msg
     */
    public function generate(string $msg): void
    {
        echo $msg . PHP_EOL;
    }
}
