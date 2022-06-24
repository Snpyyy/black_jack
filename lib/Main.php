<?php

namespace BlackJack;

require_once('Game.php');

use BlackJack\Game;

$game = new Game(2);
$game->start();
