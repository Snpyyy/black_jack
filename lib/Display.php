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
        if ($name === 'ディーラー') {
            $card = new Card(substr($drawCards[0], 0, 1), substr($drawCards[0], 1, strlen($drawCards[0]) - 1));
            echo "{$name}の引いたカードは{$card->getSuit()}の{$card->GetNum()}です。" . PHP_EOL;
            echo "{$name}の引いた2枚目のカードはわかりません。" . PHP_EOL;
        } else {
            foreach ((array)$drawCards as $drawCard) {
                $card = new Card(substr($drawCard, 0, 1), substr($drawCard, 1, strlen($drawCard) - 1));
                echo "{$name}の引いたカードは{$card->getSuit()}の{$card->getNum()}です。" . PHP_EOL;
            }
        }
    }

    /**
     * @param int $totalScore
     * @param string $name
     */
    public function isDrawCardView(int $totalScore, string $name): void
    {
        echo "{$name}の現在の得点は{$totalScore}です。カードを引きますか？(Y/N)" . PHP_EOL;
    }

    /**
     * @param array<string> $hand
     * @param string $name
     */
    public function secondDrawCardView(array $hand, string $name): void
    {
        $card = new Card(substr($hand[1], 0, 1), substr($hand[1], 1, strlen($hand[1]) - 1));
        echo "{$name}の引いた2枚目のカードは{$card->getSuit()}の{$card->getNum()}でした。" . PHP_EOL;
    }

    /**
     * @param int $totalScore
     * @param string $name
     */
    public function totalScoreView(int $totalScore, string $name): void
    {
        echo "{$name}の現在の得点は{$totalScore}です。" . PHP_EOL;
    }

    /**
     * @param int $userScore
     * @param int $dealerScore
     */
    public function judgeView(int $userScore, int $dealerScore): void
    {
        if ($userScore > 21 && $dealerScore > 21) {
            echo '勝負はドローです。' . PHP_EOL;
        } elseif ($userScore > 21) {
            echo 'ディーラーの勝ちです。' . PHP_EOL;
        } elseif ($dealerScore > 21) {
            echo 'あなたの勝ちです。' . PHP_EOL;
        } elseif ($userScore === $dealerScore) {
            echo '勝負は引き分けです。' . PHP_EOL;
        } elseif ($userScore > $dealerScore) {
            echo 'あなたの勝ちです。' . PHP_EOL;
        } else {
            echo 'ディーラーの勝ちです。' . PHP_EOL;
        }
    }

    /**
     * @param string $drawCard
     * @param string $name
     */
    public function getDrawCardView(string $drawCard, string $name): void
    {
        $card = new Card(substr($drawCard, 0, 1), substr($drawCard, 1, strlen($drawCard) - 1));
        echo "{$name}の引いたカードは{$card->getSuit()}の{$card->getNum()}です。" . PHP_EOL;
    }

    /**
     * @param string $msg
     */
    public function generate(string $msg): void
    {
        echo $msg . PHP_EOL;
    }
}
