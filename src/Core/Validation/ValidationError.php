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
  
  private $messages = [
    'required' => "Ce champs est requis",
    'notEmpty' => "Ce champs est obligatoire",
    'email' => "Le champs email doit être valide",
    'slug' => "Ce champs n'est pas valide (a-z 0-9 -)",
    'minLength' => "Minimum requis %d caractères",
    'maxLength' => "Maximum requis %d caractères",
    'betweenLength' => "Minimum requis entre %d et %d caractères",
    'dateTime' => "La date et l'heure doivent être valide (%s)",
    'date' => "La date doit être valide (%s)",
    'time' => "L'heure doit être valide (%s)",
    'exists' => "Ce champs n'existe pas",
  ];

  /**
   * @var string
   */
  private $rule;

  public function __construct(string $rule, array $attributes = []) {
    $this->rule = $rule;
    $this->attributes = $attributes;
  }
  
  public function __toString() {
    $params = array_merge([$this->messages[$this->rule]], $this->attributes);
    
    return (string) call_user_func_array('sprintf', $params);
  }
}
