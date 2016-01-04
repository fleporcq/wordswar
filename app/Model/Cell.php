<?php

namespace WordsWar\Model;

use ErrorException;
use WordsWar\Model\Tile\Tile;
use Zend\Stdlib\Hydrator\Strategy\Exception\InvalidArgumentException;

/**
 * Une cellule est une case d'une grille
 * 
 * @package WordsWar\Model
 */
class Cell {

    protected $tile;
    
    public function __construct() {
        
    }
    
    /**
     * Pose une tuile dans la cellule
     * @param Tile $tile
     * @throws InvalidArgumentException
     * @throws ErrorException
     */
    public function setTile(Tile $tile){
        if($tile == NULL){
            throw new InvalidArgumentException('$tile arg cannot be null');
        }
        if($this->tile != NULL){
            throw new ErrorException('This cell contains already a tile');
        }
        $this->tile = $tile;
    }
    
    /**
     * Retourne la tuile posée dans la cellule
     * @return Tile
     */
    public function getTile(){
        return $this->tile;
    }
    
    /**
     * Vérifie si la cellule contient une tuile
     * @return boolean true si la cellule contient une tuile sinon false
     */
    public function hasTile(){
        return $this->tile != NULL;
    }

}
