<?php

namespace WordsWar\Model\Tile;

use InvalidArgumentException;
use WordsWar\Model\LetterType;
use WordsWar\Model\Tile\Tile;

/**
 * Tuile de type letter
 * @package WordsWar\Model\Tile
 */
class LetterTile implements Tile{

    /** @var string La lettre de la tuile */
    protected $letter;

    /** @var LetterType le type de la lettre consonne/voyelle */
    protected $type;

    /** @var int Le score de la tuile */
    protected $score;

    /**
     * Construit une nouvelle tuile de type lettre
     * @param string $letter
     * @param LetterType $type
     * @param int $score
     * @throws InvalidArgumentException
     */
    public function __construct($letter, LetterType $type, $score = 1) {

        if ($letter == NULL || !is_string($letter)) {
            throw new InvalidArgumentException('$letter arg cannot be null and must be a string');
        }
        if (preg_match('/[A-Z]/', $letter)) {
            throw new InvalidArgumentException('$letter must be a char in A-Z range');
        }
        if ($score == NULL || !is_int($score) || $score < 1) {
            throw new InvalidArgumentException('$score arg cannot be null and must be an integer greater than 1');
        }
        if ($type == NULL) {
            throw new InvalidArgumentException('$type arg cannot be null');
        }

        $this->letter = $letter;
        $this->score = $score;
        $this->type = $type;
    }
    
    /**
     * Retourne la lettre de la tuile
     * @return string
     */
    public function getLetter() {
        return $this->letter;
    }

    /**
     * Retourne le type de la lettre 
     * @return LetterType
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Retourne le score de la lettre
     * @return int
     */
    public function getScore() {
        return $this->score;
    }


    
}
