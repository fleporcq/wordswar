<?php

namespace WordsWar\Model;

use InvalidArgumentException;
use OutOfRangeException;
use WordsWar\Model\Tile\Tile;

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
    protected $size;

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
        $this->size = $this->width * $this->height;
        $this->cells = [];
        for ($i = 0; $i < $this->size; $i++) {
            $this->cells[] = new Cell();
        }
    }

    
    public function addTiles($tiles){
        if ($tiles == NULL || !is_array($tiles)) {
            throw new InvalidArgumentException('$tiles arg cannot be null and must be an array of Tile instances');
        }
        foreach($this->cells as $cell){
            if(!$cell->hasTile()){
                $cell->setTile(array_pop($tiles));
            }
        }
    }

    public function removeTile($x, $y) {
        unset($this->cells[$this->getKey($x, $y)]);
    }

    protected function getKey($x, $y) {
        if ($x == NULL || !is_int($x) || $y == NULL || !is_int($y)) {
            throw new InvalidArgumentException('$x and $y args cannot be null and must be integers');
        }
        if ($x < 0 || $x > $this->width) {
            throw new OutOfRangeException('$x is out of range');
        }
        if ($y < 0 || $y > $this->height) {
            throw new OutOfRangeException('$y is out of range');
        }
        //TODO
    }

    /**
     * Retourne la taille de la grille
     * @return int
     */
    public function getSize() {
        return $this->size;
    }
    
    /**
     * Retourne la largeur de la grille
     * @return int
     */
    public function getWidth() {
        return $this->width;
    }
    
    /**
     * Retourne la hauteur de la grille
     * @return int
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * Retourne les cellules de la grille
     * @return array
     */
    public function getCells(){
        return $this->cells;
    }
}
