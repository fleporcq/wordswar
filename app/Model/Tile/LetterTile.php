<?php

namespace WordsWar\Model\Tile;

use InvalidArgumentException;
use WordsWar\Model\LetterType;
use WordsWar\Model\Tile\Tile;

/**
 * Tuile de type lettre
 * @package WordsWar\Model\Tile
 */
class LetterTile extends Tile {

    /** @var string La lettre de la tuile */
    protected $letter;

    /**
     * Construit une nouvelle tuile de type lettre
     * @param string $letter
     * @param int $score
     * @throws InvalidArgumentException
     */
    public function __construct($letter, $score = 1) {

        if ($letter == NULL || !is_string($letter)) {
            throw new InvalidArgumentException('$letter arg cannot be null and must be a string');
        }
        if (preg_match('/[A-Z]/', $letter)) {
            throw new InvalidArgumentException('$letter must be a char in A-Z range');
        }
        if ($score == NULL || !is_int($score) || $score < 1) {
            throw new InvalidArgumentException('$score arg cannot be null and must be an integer greater than 1');
        }

        $this->letter = $letter;
        $this->score = $score;
    }

    /**
     * Retourne la lettre de la tuile
     * @return string
     */
    public function getLetter() {
        return $this->letter;
    }

    public function __toString() {
        return $this->getLetter();
    }

}
