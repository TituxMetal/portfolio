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
   * Returns the Contact object if it has been correctly inserted, or false.
   * 
   * @param Contact $contact The Contact to insert in database.
   * @return boolean|Contact The Contact object or false. if errors
   */
  public function insert(Contact $contact) {
    $contactData = [
      'name' => htmlspecialchars($contact->name()),
      'email' => htmlspecialchars($contact->email()),
      'subject' => htmlspecialchars($contact->subject()),
      'message' => htmlspecialchars($contact->message())
    ];
    
    $statement = $this->getDb()->prepare(
      "INSERT INTO contacts
      (name, email, subject, message)
      VALUES(:name, :email, :subject, :message)"
    );
    $statement->execute($contactData);
    
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
   * - Check if fields are in the required fields array and is not empty values
   * - Check if the email field is valid and not empty value
   * - Check if all the fields has at least five characters
   * 
   * If it is not errors, build the Contact object with the validated data or
   * returns the errors array
   * 
   * @param array $fields The fields to validate.
   * @return Contact|array Returns the Contact object, or validation errors. 
   */
  public function validate(array $fields) {
    
    foreach($fields as $field => $value) {
      
      if(!array_key_exists($field, $this->requiredFields) || empty($value)) {
        $this->addError(
          $field,
          "Le champ {$this->requiredFields[$field]} est requis."
        );
      }
      
      if(
        $field === 'contactEmail'
        && !$this->isValidEmail($value)
        && !empty($value)
      ) {
        $this->addError($field, "Le champ email doit contenir un email valide.");
      }
      
      if(strlen($value) > 0 && strlen($value) < 5) {
        $this->addError(
          $field,
          "Le champ {$this->requiredFields[$field]} doit contenir au moins 5 caractères."
        );
      }
    }
    
    if($this->isValid()) {
      
      return $this->buildDomainObject($fields);
    }
    
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
