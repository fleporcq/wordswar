<?php

namespace WordsWar\Configuration;

use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;
use WordsWar\Exception\ConfigurationKeyNotExists;
use WordsWar\Exception\LoadFileException;

/**
 * Une configuration défini un ensemble de tuples clé / valeur
 * 
 * @package WordsWar\Configuration
 */
class Configuration {

    /** @var string le nom complet du fichier de configuration*/
    protected $filename;
    
    /** @var array le tableau indexé des valeurs de configuration*/
    protected $values;

    /**
     * Construit un objet de configuration
     * @param type $filename
     * @throws InvalidArgumentException
     * @throws LoadFileException
     */
    public function __construct($filename) {
        if ($filename == NULL || !is_string($filename)) {
            throw new InvalidArgumentException('$filename arg cannot be null and must be a string');
        }

        if (!is_readable($filename)) {
            throw new LoadFileException('Cannot read the file ' . $filename);
        }

        $this->filename = $filename;

        $values = Yaml::parse(file_get_contents($filename));

        if (array_key_exists('extends', $values)) {
            $extendsFilename = dirname($filename) . DIRECTORY_SEPARATOR . $values['extends'];

            if (!is_readable($extendsFilename)) {
                throw new LoadFileException('Cannot read the file ' . $extendsFilename);
            }
            $extends = new Configuration($extendsFilename);
            $values = array_replace_recursive($extends->toArray(), $values);
        }

        $this->values = $values;
    }

    /**
     * Retourne le nom complet du fichier de configuration
     * @return string
     */
    public function getFilename() {
        return $this->filename;
    }

    /**
     * Retourne la configuration sous forme d'un tableau indexé
     * @return array
     */
    public function toArray() {
        return $this->values;
    }

    /**
     * Retourne la valeur associée à une clé de configuration
     * @param string $key
     * @return string
     * @throws ConfigurationKeyNotExists
     * @throws InvalidArgumentException
     */
    public function get($key) {
        if ($key == NULL || !is_string($key)) {
            throw new InvalidArgumentException('$key arg cannot be null and must be a string');
        }
        $keys = explode(":", $key);
        $array = $this->values;
        foreach ($keys as $k) {
            if (array_key_exists($k, $array)) {
                $array = $array[$k];
            } else {
                throw new ConfigurationKeyNotExists('[' . $key . '] This configuration key does not exist (' . $k . ')');
            }
        }
        return $array;
    }

}
