<?php

namespace WordsWar\Model;

/**
 * Une partie
 *
 */
class Game {

    /** @var Language la langue de la partie */
    protected $language;

    /** @var Dictionary le dictionaire de la partie */
    protected $dictionary;

    /** @var Grid la grille de la partie */
    protected $grid;

    /**
     * Démarre une nouvelle partie
     * @param Language $language
     * @param Dictionary $dictionary
     * @param Grid $grid
     */
    public function __construct(Language $language, Dictionary $dictionary,  Pick $pick, Grid $grid) {
        $this->language = $language;
        $this->dictionary = $dictionary;
        $this->grid = $grid;
    }

    /**
     * Retourne le dictionnaire de la partie
     * @return Dictionary
     */
    public function getDictionary() {
        return $this->dictionary;
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
        $this->grid;
    }

}
