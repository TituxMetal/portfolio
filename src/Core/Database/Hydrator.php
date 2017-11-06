<?php

namespace Portfolio\Core\Database;

/**
 * Description of Hydrator
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Hydrator {

  public static function hydrate(array $array, $object) {
    $instance = (is_string($object)) ? new $object() : $object;
    
    foreach ($array as $key => $value) {
      $method = self::getSetter($key);
      
      $property = lcfirst(self::getProperty($key));
      (method_exists($instance, $method)) ? $instance->$method($value) : $instance->$property = $value;
    }
    
    return $instance;
  }

  private static function getSetter(string $fieldName): string {
    
    return 'set' . self::getProperty($fieldName);
  }

  private static function getProperty(string $fieldName): string {
    
    return join('', array_map('ucfirst', [$fieldName]));
  }
}
