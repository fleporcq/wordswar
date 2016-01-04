<?php

use WordsWar\GameFactory;
use WordsWar\Model\Language;

require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

$gameFactory = GameFactory::getInstance();
/* @var $game \WordsWar\Model\Game */
$game = $gameFactory->createNewGame(Language::FR(), 6, 6);
$game->start();
$grid = $game->getGrid();


$config = new \Doctrine\DBAL\Configuration();
// the connection configuration
$connectionParams = [
    'url'   => 'sqlite:///:memory:',
];
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

?>

<table border="1" width="400">
<?php
$width = $grid->getWidth();
/* @var $cell \WordsWar\Model\Cell */
foreach($grid->getCells() as $key => $cell):
    $key++;
    $tile = $cell->getTile();
    ?>
    <?php if($key == 1 || $key%$width == 1):?>
        <tr>
    <?php endif;?>

            <td><?php echo strtoupper($tile); ?><small><?php echo $tile->getScore(); ?></small></td>
        
   <?php if($key%$width == 0):?>
        </tr>
    <?php endif;?>
<?php endforeach; ?>
</table>