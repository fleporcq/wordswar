<?php

namespace WordsWar\Model;

use InvalidArgumentException;
use WordsWar\Configuration\Configuration;
use WordsWar\Exception\LoadFileException;

/**
 * Un dictionnaire contient l'ensemble des mots autorisés pour une langue
 * 
 * @package WordsWar\Model
 */
class Dictionary {

    /** @var Language La langue du dictionnaire */
    protected $language;

    /** @var string Le contenu du fichier texte utilisé pour créer le dictionnaire */
    protected $content;

    /**
     * Construit un nouveau dictionnaire
     * @param Configuration $configuration La configuration globale de l'application
     * @param Language $language La langue du dictionnaire
     * @throws InvalidArgumentException
     * @throws LoadFileException
     */
    public function __construct(Configuration $configuration, Language $language) {
        if ($configuration == NULL) {
            throw new InvalidArgumentException('$configuration arg cannot be null');
        }
        
        if ($language == NULL) {
            throw new InvalidArgumentException('$language arg cannot be null');
        }
        
        $filepath = $configuration->get('dictionaries:path') . DIRECTORY_SEPARATOR . $language . '.txt';

        if (!is_readable($filepath)) {
            throw new LoadFileException('Cannot read the file ' . $filepath);
        }
        $this->language = $language;
        $this->content = file_get_contents($filepath);
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
