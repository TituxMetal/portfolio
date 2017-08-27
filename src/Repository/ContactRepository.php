<?php

namespace Tuxi\Portfolio\Repository;

use Tuxi\Portfolio\Entity\Contact;

/**
 * Object allowing access to the data of contacts entity.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ContactRepository extends Repository {
  
  /**
   * Validation errors, if any.
   *
   * @var array
   */
  private $errors = [];
  
  /**
   * Required fields for validation.
   *
   * @var array
   */
  private $requiredFields = [
    'contactName' => 'name',
    'contactEmail' => 'email',
    'contactSubject' => 'subject',
    'contactMessage' => 'message',
  ];
  
  /**
   * Insert Contact object data in database.
   * 
   * @param Contact $contact The Contact to insert in database.
   * @return boolean|Contact Returns the Contact object if it has been correctly inserted, or false.
   */
  public function insert(Contact $contact) {
    $contactData = [
      'name' => $contact->name(),
      'email' => $contact->email(),
      'subject' => $contact->subject(),
      'message' => $contact->message()
    ];
    
    $statement = $this->getDb()->insert('contacts', $contactData);
    if($statement) {
      $id = $this->getDb()->lastInsertId();
      $contact->setId($id);
      
      return $contact;
    }
    
    $this->errors[] = "Une erreur interne est survenue";
    
    return false;
  }
  
  /**
   * Get validation errors, if any.
   * 
   * @return array Returns an array with all validation errors.
   */
  public function errors(): array {
    
    return $this->errors;
  }
  
  /**
   * Check if there are validation errors.
   * 
   * @return boolean Returns true if there are errors, or false if not.
   */
  public function hasErrors(): bool {
    if(count($this->errors) > 0) {
      
      return true;
    }
    
    return false;
  }
  
  /**
   * Validate all fields comming from the user.
   * 
   * @param array $fields The fields to validate.
   * @return Contact|array Returns the Contact object, or validation errors. 
   */
  public function validate(array $fields) {
    
    foreach($fields as $field => $value) {
      // Check if all fields are in the required fields array and it's not empty values
      if(!array_key_exists($field, $this->requiredFields) || empty($value)) {
        $this->addError($field, "Le champ {$this->requiredFields[$field]} est requis.");
      }
      // Check if the email field is a valid email and not empty value
      if($field === 'contactEmail' && !$this->isValidEmail($value) && !empty($value)) {
        $this->addError($field, "Le champ email doit contenir un email valide.");
      }
      // Check if all the fields has at least five characters
      if(strlen($value) > 0 && strlen($value) < 5) {
        $this->addError($field, "Le champ {$this->requiredFields[$field]} doit contenir au moins 5 caractères.");
      }
    }
    // If it is not errors we build the Contact object with the validated data
    if($this->isValid()) {
      
      return $this->buildDomainObject($fields);
    }
    // or we returns the errors array
    return $this->errors();
  }
  
  /**
   * Check if all data are valid.
   * 
   * @return boolean Returns true if it's valid or false.
   */
  private function isValid(): bool {
    
    return $this->hasErrors() ? false : true;
  }
  
  /**
   * Check if an email is valid.
   * 
   * @param string $email The email to check.
   * @return boolean Returns true if the email is valid or false.
   */
  private function isValidEmail(string $email): bool {
    
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
  }
  
  /**
   * Add an error in the errors array.
   * 
   * @param string $field The field name.
   * @param string $message The error message to add.
   */
  private function addError(string $field, string $message) {
    $this->errors[$field] = $message;
  }

  /**
   * Creates a Contact object.
   * 
   * @param array $row The Contact data.
   * @return Tuxi\Portfolio\Entity\Contact The Contact object.
   */
  protected function buildDomainObject(array $row): Contact {
    $contact = new Contact();
    $contact->setName($row['contactName'])
      ->setSubject($row['contactSubject'])
      ->setEmail($row['contactEmail'])
      ->setMessage($row['contactMessage']);
    
    return $contact;
  }

}
