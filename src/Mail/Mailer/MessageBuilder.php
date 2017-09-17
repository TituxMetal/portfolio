<?php

namespace Tuxi\Portfolio\Mail\Mailer;

use Swift_Message;

/**
 * This class wraps Swift_Message methods to build a message.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class MessageBuilder {
  
  /*
   * @var Swift_Message
   */
  protected $swiftMessage;
  
  /**
   * Constructor.
   * 
   * @param Swift_Message $swiftMessage
   */
  public function __construct(Swift_Message $swiftMessage) {
    $this->swiftMessage = $swiftMessage;
  }
  
  /**
   * Set the to addresses of this message.
   * 
   * @param string $address The address for to
   * @param string|null $name The name for to, if any.
   */
  public function to($address, $name = null) {
    $this->swiftMessage->setTo($address, $name);
    
    return $this;
  }
  
  /**
   * Set the subject of this message.
   * 
   * @param string $subject The subject of the message.
   */
  public function subject($subject) {
    $this->swiftMessage->setSubject($subject);
    
    return $this;
  }
  
  /**
   * Set the body of this message.
   * 
   * @param string $body The body of the message.
   */
  public function body($body) {
    $this->swiftMessage->setBody($body, 'text/html');
    
    return $this;
  }
  
  /**
   * Set the from address of this message.
   * 
   * @param string $address The address to set.
   * @param string|null $name The name to set, if any.
   */
  public function from($address, $name = null) {
    $this->swiftMessage->setFrom($address, $name);
    
    return $this;
  }
  
  /**
   * Get the Swift_message instance.
   * 
   * @return Swift_Message The Swift_Message instance.
   */
  public function swiftMessage() {
    
    return $this->swiftMessage;
  }
  
}
