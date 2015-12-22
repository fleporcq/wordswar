<?php

namespace WordsWar;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use WordsWar\Model\Language;

/**
 * Classe permettant d'instancier et de récupérer le container de services
 * 
 */
final class GameFactory {

    /** @var ContainerBuiler Le container de services*/
    private $container;
    
    /** @var GameFactory Le singloton*/
    private static $instance;

    /**
     * Construit le singloton
     */
    private function __construct() {
        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->container, new FileLocator('config'));
        $loader->load('services.yml');
    }

    /**
     * Retourne le singloton
     * @return ContainerBuiler
     */
    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new GameFactory();
        }
        return self::$instance;
    }

    /**
     * Crée et retroune une instance de partie
     * @param Language $language La langue de la partie
     * @param int $width La largeur de la grille de jeu
     * @param int $height La hauteur de la grille de jeu
     * @return Model\Game
     */
    public function createNewGame(Language $language, $width, $height) {
        $this->container->setParameter('language', $language);
        $this->container->setParameter('lang', $language->getValue());
        $this->container->setParameter('grid.width', $width);
        $this->container->setParameter('grid.height', $height);
        return $this->container->get('game');
    }

}
