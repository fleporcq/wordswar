<?php

use WordsWar\Model\Language;
use WordsWar\GameFactory;

require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

$gameFactory = GameFactory::getInstance();
$game = $gameFactory->createNewGame(Language::FR(), 6, 6);
$dictionary = $game->getDictionary();
var_dump($dictionary->wordExists('truculentes'));
$grid = $game->getGrid();