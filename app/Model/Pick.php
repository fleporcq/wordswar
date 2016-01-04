<?php

namespace WordsWar\Model;

use InvalidArgumentException;
use OutOfRangeException;
use WordsWar\Configuration\Configuration;
use WordsWar\Model\Tile\LetterTile;
use WordsWar\Model\Tile\Tile;

/**
 * La pioche représente les tuiles disponibles qui ne sont pas posées sur la grille de jeu
 *
 */
class Pick {

    /** @var array les tuiles de la pioche */
    protected $tiles;

    /**
     * Construit la pioche
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration) {

        $configurationArray = $configuration->toArray();

        foreach ($configurationArray['letters'] as $letter => $data) {
            for ($i = 0; $i < $data['count']; $i++) {
                $this->push(new LetterTile($letter, $data['score']));
            }
        }
    }

    public function push(Tile $tile) {
        $this->tiles[] = $tile;
    }

    public function pop($count = 1) {
        if (!is_int($count)) {
            throw new InvalidArgumentException('$count arg must be an integer');
        }
        if ($count < 1 || $count > count($this->tiles)) {
            throw new OutOfRangeException('$count arg must be lower or equals than leaving tiles count and greater than 0');
        }
        
        $picked = [];
        $keys = array_rand($this->tiles, $count);
        
        if (is_array($keys)) {
            foreach ($keys as $key) {
                $picked[] = $this->tiles[$key];
                unset($this->tiles[$key]);
            }
        }else{
            $picked[] = $this->tiles[$keys];
             unset($this->tiles[$keys]);
        }
        
        shuffle($picked);
        return $picked;
    }

}
