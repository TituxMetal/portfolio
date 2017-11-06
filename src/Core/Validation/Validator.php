<?php

namespace Portfolio\Core\Validation;

use DateTime;
use Portfolio\Core\Database\Table;
use Portfolio\Core\Validation\ValidationError;

/**
 * Description of Validator
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Validator {

  /**
   * @var array
   */
  private $params;
  
  /**
   * @var string[]
   */
  private $errors = [];

  public function __construct(array $params) {
    $this->params = $params;
  }
  
  /**
   * Check that required fields are in params array
   *
   * @param string $keys
   * @return Validator
   */
  public function required(string ...$keys): self {
    
    foreach ($keys as $key) {
      $value = $this->getValue($key);
      
      if (is_null($value)) {
        $this->addError($key, 'required');
      }
    }
    
    return $this;
  }
  
  /**
   * Check that required fields are in params array
   *
   * @param string $keys
   * @return Validator
   */
  public function notEmpty(string ...$keys): self {
    
    foreach ($keys as $key) {
      $value = $this->getValue($key);
      
      if (empty($value) || is_null($value)) {
        $this->addError($key, 'notEmpty');
      }
    }
    
    return $this;
  }
  
  /**
   * Check that's a valid slug
   *
   * @param string $key
   * @return Validator
   */
  public function slug(string $key): self {
    $value = $this->getValue($key);
    $pattern = '/^([a-z0-9])+(-[a-z0-9]+)*$/';
    
    if (!is_null($value) && !preg_match($pattern, $value)) {
      $this->addError($key, 'slug');
    }
    
    return $this;
  }
  
  /**
   * Check that a field exists
   *
   * @param string $key
   * @param Table $table
   * @return Validator
   */
  public function exists(string $key, Table $table): self {
    $value = $this->getValue($key);
    
    if (!$table->exists($value)) {
      $this->addError($key, 'exists', [$table->getTable()]);
    }
    
    return $this;
  }
  
  /**
   * Check that the field has a valid length
   *
   * @param string $key
   * @param int|null $min
   * @param int|null $max
   * @return Validator
   */
  public function length(string $key, int $min = null, int $max = null): self {
    $value = $this->getValue($key);
    $length = mb_strlen($value);
    
    if (!is_null($min) && $length < $min) {
      $this->addError($key, 'minLength', [$min]);
    }
    
    if (is_null($min) && !is_null($max) && $length > $max) {
      $this->addError($key, 'maxLength', [$max]);
    }
    
    if (!is_null($min) && !is_null($max) && ($length > $max || $length < $min)) {
      $this->addError($key, 'betweenLength', [$min, $max]);
    }
    
    return $this;
  }
  
  /**
   * Check if the datetime is valid.
   *
   * @param string $key
   * @return Validator
   */
  public function dateTime(string $key): self {
    $value = $this->getValue($key);
    $format = 'Y-m-d H:i:s';
    
    return $this->validDateOrTime($format, $key, $value, 'dateTime');
  }
  
  /**
   * Check if the date is valid.
   *
   * @param string $key
   * @return Validator
   */
  public function date(string $key): self {
    $value = $this->getValue($key);
    $format = 'Y-m-d';
    
    return $this->validDateOrTime($format, $key, $value, 'date');
  }
  
  /**
   * Check if the time is valid.
   *
   * @param string $key
   * @return Validator
   */
  public function time(string $key): self {
    $value = $this->getValue($key);
    $format = 'H:i:s';
    
    return $this->validDateOrTime($format, $key, $value, 'time');
  }
  
  /**
   * Get errors
   *
   * @return ValidationError[]
   */
  public function getErrors(): array {
    
    return $this->errors;
  }
  
  public function isValid(): bool {
    return empty($this->getErrors());
  }
  
  /**
   * Add an error in the errors array
   *
   * @param string $key
   * @param string $rule
   * @return void
   */
  private function addError(string $key, string $rule, array $attributes = []): void {
    $this->errors[$key] = new ValidationError($key, $rule, $attributes);
  }
  
  /**
   * Get the value of the given key
   *
   * @param string $key
   * @return string|null
   */
  private function getValue(string $key) {
    if (array_key_exists($key, $this->params)) {
      return $this->params[$key];
    }
    
    return null;
  }
  
  /**
   * Check if a $type (date|time|datetime) is valid and add an error with
   * this type.
   *
   * @param string $format
   * @param string $key
   * @param string $value
   * @param string $type
   * @return Validator
   */
  private function validDateOrTime(string $format, string $key, string $value, string $type): self {
    $dateOrTime = DateTime::createFromFormat($format, $value);
    $errors = DateTime::getLastErrors();
    
    if ($errors['error_count'] > 0 || $errors['warning_count'] > 0 || $dateOrTime === false) {
      $this->addError($key, $type, [$format]);
    }
    
    return $this;
  }
}
