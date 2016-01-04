<?php

namespace WordsWar\Model\Tile;

/**
 * Une tuile peut être posée dans une cellule innocupé d'une gille
 */
abstract class Tile {

    /** @var int Le score de la tuile */
    protected $score;

    /**
     * Retourne le score de la lettre
     * @return int
     */
    public function getScore() {
        return $this->score;
    }

}
