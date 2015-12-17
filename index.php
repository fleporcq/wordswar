<?php

use WordsWar\Model\Dictionary;

require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

$dictionary = new Dictionary(__DIR__ . '/resources/dictionaries/fr.txt');
var_dump($dictionary->wordExists('truculentes'));
