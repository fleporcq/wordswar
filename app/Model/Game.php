<?php

namespace WordsWar\Model;

/**
 * Une partie
 *
 */
class Game {

    /** @var Language la langue de la partie*/
    protected $language;

    /** @var Dictionary le dictionaire*/
    protected $dictionary;

    /** @var Pick la pioche*/
    protected $pick;

    /** @var Grid la grille de jeu*/
    protected $grid;

    /**
     * Démarre une nouvelle partie
     * @param Language $language
     * @param Dictionary $dictionary
     * @param Pick $pick
     * @param Grid $grid
     */
    public function __construct(Language $language, Dictionary $dictionary,  Pick $pick, Grid $grid) {
        $this->language = $language;
        $this->dictionary = $dictionary;
        $this->pick = $pick;
        $this->grid = $grid;
    }
    
    /**
     * Retourne la grille de jeu
     * @return Grid
     */
    public function getGrid() {
        return $this->grid;
    }
    
    /**
     * Démarre la partie et initialise la grille de jeu
     */
    public function start(){
        $tiles = $this->pick->pop($this->grid->getSize());
        $this->grid->addTiles($tiles);
    }

}
