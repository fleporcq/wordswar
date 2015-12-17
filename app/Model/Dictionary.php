<?php

namespace WordsWar\Model;

use InvalidArgumentException;
use WordsWar\Exception\LoadFileException;

/**
 * Un dictionnaire contient l'ensemble des mots autorisés pour une langue
 * 
 * @package WordsWar\Model
 */
class Dictionary {

    /** @var string Le chemin complet du fichier texte utilisé pour créer le dictionnaire */
    protected $filename;

    /** @var string Le contenu du fichier texte utilisé pour créer le dictionnaire */
    protected $content;

    /**
     * Construit un nouveau dictionnaire
     * @param string $filename Le chemin complet du fichier texte utilisé pour créer le dictionnaire
     * @throws InvalidArgumentException
     * @throws LoadFileException
     */
    public function __construct($filename) {
        if ($filename == NULL) {
            throw new InvalidArgumentException('$filename arg cannot be null');
        }
        if (!is_readable($filename)) {
            throw new LoadFileException('Cannot read the file ' . $filename);
        }
        $this->filename = $filename;
        $this->content = file_get_contents($this->filename);
    }

    /**
     * Vérifie si le mot passé en argument existe dans le dictionnaire
     * @param string $word Le mot dont on veut vérifier l'existence
     * @return boolean true si le mot existe dans le dictionnaire sinon false
     * @throws InvalidArgumentException
     */
    public function wordExists($word) {
        if ($word == NULL || !is_string($word)) {
            throw new InvalidArgumentException('$word arg cannot be null and must be a string');
        }
        return preg_match("/^{$word}/mi", $this->content) === 1;
    }

    /**
     * Retourne le countenu brut du dictionnaire
     * @return string
     */
    function getContent() {
        return $this->content;
    }

}
