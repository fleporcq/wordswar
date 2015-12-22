<?php

namespace WordsWar\Model;

use OutOfRangeException;
use WordsWar\Model\Tile\Tile;
use Zend\Stdlib\Hydrator\Strategy\Exception\InvalidArgumentException;

/**
 * Une grille représente l'espace de jeu
 * 
 * @package WordsWar\Model
 */
class Grid {

    /** @var int La largeur de la grille */
    protected $width;

    /** @var int La hauteur de la grille */
    protected $height;

    /** @var array les cellules de la grille */
    protected $cells;
    
    /** @var int le nombre de cellules de la grille */
    protected $cellsCount;

    /**
     * Construit une nouvelle grille de jeu
     * @param type $width
     * @param type $height
     */
    public function __construct($width = 4, $height = 4) {
        if ($width == NULL || !is_int($width) || $height == NULL || !is_int($height)) {
            throw new InvalidArgumentException('$width and $height args cannot be null and must be integers');
        }
        if ($width <= 1 || $height <= 1) {
            throw new InvalidArgumentException('$width and $height must be greater than 1');
        }
        $this->width = $width;
        $this->height = $height;
        $this->cellsCount = $this->width * $this->height;
        $this->cells = array($this->cellsCount);
    }

    public function addTile(Tile $tile, $x, $y) {
        if ($tile == NULL) {
            throw new InvalidArgumentException('$tile arg cannot be null');
        }
        $this->cells[$this->getKey($x, $y)] = $tile;
    }

    public function removeTile($x, $y) {
        unset($this->cells[$this->getKey($x, $y)]);
    }

    protected function getKey($x, $y){
        if ($x == NULL || !is_int($x) || $y == NULL || !is_int($y)) {
            throw new InvalidArgumentException('$x and $y args cannot be null and must be integers');
        }
        if ($x < 0 || $x > $this->width) {
            throw new OutOfRangeException('$x is out of range');
        }
        if ($y < 0 || $y > $this->height) {
            throw new OutOfRangeException('$y is out of range');
        }
    }
}
