<?php

namespace Portfolio\Core\Validation;

/**
 * Description of ValidationError
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ValidationError {

  /**
   * @var array
   */
  private $attributes;

  /**
   * @var string
   */
  private $rule;

  /**
   * @var string
   */
  private $key;
  
  private $messages = [
    'required' => "Le champs %s est requis",
    'notEmpty' => "Le champs %s ne doit pas être vide",
    'slug' => "Le champs %s n'est pas valide (a-z 0-9 -)",
    'minLength' => "La longueur du champs %s doit être au minimum de %d caractères",
    'maxLength' => "La longueur du champs %s doit être au maximum de %d caractères",
    'betweenLength' => "La longueur du champs %s doit être comprise entre %d et %d caractères",
    'dateTime' => "Le champs %s doit être une date valide (%s)",
    'date' => "Le champs %s doit être une date valide (%s)",
    'time' => "Le champs %s doit être une heure valide (%s)",
    'exists' => "Le champs %s n'existe pas dans la table %s",
  ];

  public function __construct(string $key, string $rule, array $attributes = []) {
    $this->key = $key;
    $this->rule = $rule;
    $this->attributes = $attributes;
  }
  
  public function __toString() {
    $params = array_merge([$this->messages[$this->rule], $this->key], $this->attributes);
    
    return (string) call_user_func_array('sprintf', $params);
  }
}
