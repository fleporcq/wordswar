<?php

namespace WordsWar\Model;

use WordsWar\Configuration\Configuration;
use WordsWar\Model\Tile\Tile;
use WordsWar\Model\Tile\LetterTile;

/**
 * La pioche représente les tuiles disponibles qui ne sont pas posées sur la grille de jeu
 *
 */
class Pick {
    
    /** @var array les tuiles de la pioche*/
    protected $tiles;
    
    /**
     * Construit la pioche
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration) {

        $configurationArray = $configuration->toArray();
        
        foreach($configurationArray['letters']['vowel'] as $letter => $data){
            $this->push(new LetterTile($letter, LetterType::VOWEL(), $data['score']));
        }
        foreach($configurationArray['letters']['consonant'] as $letter => $data){
            $this->push(new LetterTile($letter, LetterType::CONSONANT(), $data['score']));
        }
    }
    
    public function push(Tile $tile){
        $this->tiles[] = $tile;
    }
    
    public function pop(){
        
    }
    
}
