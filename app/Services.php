<?php

namespace WordsWar;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Classe permettant d'instancier le container de services
 *
 */
class Services {

    /** @var ContainerBuiler Le container de services */
    private static $container;

    private function __construct() {
        
    }

    /**
     * Retourne le container de services
     * @return ContainerBuiler
     */
    public static function getContainer() {

        if (self::$container == NULL) {
            self::$container = new ContainerBuilder();
            $loader = new YamlFileLoader(self::$container, new FileLocator('config'));
            $loader->load('services.yml');
        }
        return self::$container;
    }

}
