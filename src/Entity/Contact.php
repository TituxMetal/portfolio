<?php

namespace Tuxi\Portfolio\Entity;

/**
 * Representation of a Contact.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Contact {
  
  /**
   * Contact id.
   *
   * @var integer
   */
  private $id;
  
  /**
   * Contact name.
   *
   * @var string
   */
  private $name;
  
  /**
   * Contact email.
   *
   * @var string
   */
  private $email;
  
  /**
   * Contact subject.
   *
   * @var string
   */
  private $subject;
  
  /**
   * Contact message
   *
   * @var string
   */
  private $message;
  
  /**
   * Get id of the contact.
   * 
   * @return int Returns the id of the contact.
   */
  public function id(): int {
    
    return $this->id;
  }
  
  /**
   * Set the id of the contact.
   * 
   * @param int $id The id to set to the contact.
   */
  public function setId(int $id) {
    $this->id = $id;
    
    return $this;
  }
  
  /**
   * Get the name of the contact.
   * 
   * @return string Returns the name of the contact.
   */
  public function name(): string {
    
    return $this->name;
  }
  
  /**
   * Set the name of the contact.
   * 
   * @param string $name The name to set to the contact.
   */
  public function setName(string $name) {
    $this->name = $name;
    
    return $this;
  }
  
  /**
   * Get the email of the contact.
   * 
   * @return string Returns the email of the contact.
   */
  public function email(): string {
    
    return $this->email;
  }
  
  /**
   * Set the email to the contact.
   * 
   * @param string $email The email to set to the contact.
   */
  public function setEmail(string $email) {
    $this->email = $email;
    
    return $this;
  }
  
  /**
   * Get the subject of the contact.
   * 
   * @return string Returns the subject of the contact.
   */
  public function subject(): string {
    
    return $this->subject;
  }
  
  /**
   * Set the subject of the contact.
   * 
   * @param string $subject The subject to set to the contact.
   */
  public function setSubject(string $subject) {
    $this->subject = $subject;
    
    return $this;
  }
  
  /**
   * Get the message of the contact.
   * 
   * @return string Returns the message of the contact.
   */
  public function message(): string {
    
    return $this->message;
  }
  
  /**
   * Set the message of the contact.
   * 
   * @param string $message The message to set to the contact.
   */
  public function setMessage(string $message) {
    $this->message = $message;
    
    return $this;
  }
  
}
