<?php

namespace WordsWar;

use ReflectionClass;

/**
 * Une énumération est l'ensemble des valeurs possibles d'une liste finie
 */
abstract class Enum {

    /** @var string La valeur de l'instance de l'énumération */
    protected $value;

    /** @var array tableau contenant les constantes définies dans la classe */
    protected static $cache = [];

    /**
     * Construit une nouvelle valeur de l'énumération
     * @param type $value
     * @throws \UnexpectedValueException
     */
    public function __construct($value) {
        if (!$this->isValidValue($value)) {
            throw new \UnexpectedValueException("Value '$value' is not part of the enum " . get_called_class());
        }
        $this->value = $value;
    }

    /**
     * Retourne les noms des constantes sous forme de tableau
     * @return array un tableau contenant les noms des constantes
     */
    public static function keys() {
        return array_keys(self::toArray());
    }

    /**
     * Retourne les constantes sous forme de tableau
     * @return array un tableau contenant constantes
     */
    public static function toArray()
    {
        $class = get_called_class();
        if (!array_key_exists($class, static::$cache)) {
            $reflection = new \ReflectionClass($class);
            static::$cache[$class] = $reflection->getConstants();
        }
        return static::$cache[$class];
    }
    
    /**
     * Vérifie si $value est une valeur valide de l'énumération
     * @param string $value
     * @return boolean true si la valeur est valide sinon false
     * @throws InvalidArgumentException
     */
    public static function isValidValue($value) {
        if ($value == NULL || !is_scalar($value)) {
            throw new InvalidArgumentException('$value arg cannot be null and must be a scalar');
        }
        return array_search($value, self::toArray(), TRUE) !== FALSE;
    }

    /**
     * Vérifie si $key est une clé valide de l'énumération
     * @param string $key
     * @return boolean true si la clé est valide sinon false
     * @throws InvalidArgumentException
     */
    public static function isValidKey($key) {
        if ($key == NULL || !is_string($key)) {
            throw new InvalidArgumentException('$key arg cannot be null and must be a string');
        }
        return array_key_exists($key, self::toArray());
    }

    /**
     * Retourne la valeur correspondante à une clé
     * @param string $key La clé dont on cherche la valeur
     * @return string la valeur si celle-ci est trouvée
     * @throws InvalidArgumentException
     */
    public static function search($key) {
        if ($key == NULL || !is_string($key)) {
            throw new InvalidArgumentException('$key arg cannot be null and must be a string');
        }
        if (!self::isValidKey($key)) {
            throw new InvalidArgumentException('This key does not exist');
        }
        return self::toArray()[strtoupper($key)];
    }

    /**
     * Retourne la valeur associée à l'instance de l'enum
     * @return scalar
     */
    public function getValue(){
        return $this->value;
    }
    
    /**
     * Retourne une valeur quand l'appel est statique comme : MyEnum::SOME_VALUE() ou SOME_VALUE est une constante de classe
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return \static
     * @throws \BadMethodCallException
     */
    public static function __callStatic($name, $arguments) {
        if (!self::isValidKey($name)) {
            throw new \BadMethodCallException("No static method or enum constant '$name' in class " . get_called_class());
        }
        return new static(self::toArray()[$name]);
        
    }

    /**
     * @return string
     */
    public function __toString() {
        return (string) $this->value;
    }

}
