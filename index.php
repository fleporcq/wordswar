<?php

use WordsWar\Model\Language;
use WordsWar\Services;

require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


$container = Services::getContainer();
$container->setParameter('language', Language::FR());
$dictionary = $container->get('dictionary');
var_dump($dictionary->wordExists('truculentes'));
