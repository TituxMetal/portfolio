<?php

namespace Portfolio\Core\Mail;

use Psr\Container\ContainerInterface;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

/**
 * Message is an adapter class for Swift_Message and Swift_Mailer
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Message {
  
  /**
   *
   * @var Swift_Mailer
   */
  private $mailer;
  
  /**
   *
   * @var Swift_Message
   */
  private $message;
  
  /**
   * @param ContainerInterface $container
   */
  public function __construct(ContainerInterface $container) {
    $this->setMailer($container);
    $this->message = new Swift_Message();
  }
  
  /**
   * Add the subject for the message
   * 
   * @param string $subject
   * @return Message
   */
  public function addSubject(string $subject): self {
    $this->message->setSubject($subject);
    
    return $this;
  }
  
  /**
   * Add the body for the message
   * The body can be a simple string or the rendered view
   * 
   * @param string $body
   * @param string $contentType
   * @return Message
   */
  public function addBody(string $body, string $contentType = null): self {
    $this->message->setBody($body, $contentType);
    
    return $this;
  }
  
  /**
   * Add a mime part for a multipart message
   * The part can be a simple string or the rendered view
   * 
   * @param string $part
   * @param string $contentType
   * @return Message
   */
  public function addPart(string $part, string $contentType = null): self {
    $this->message->addPart($part, $contentType);
    
    return $this;
  }
  
  /**
   * Add the "to" for the message
   * 
   * @param string $to
   * @param string $name
   * @return Message
   */
  public function addTo(string $to, string $name = null): self {
    $this->message->setTo($to, $name);
    
    return $this;
  }
  
  /**
   * Add the "from" for the message
   * 
   * @param string $from
   * @param string $name
   * @return Message
   */
  public function addFrom(string $from, string $name = null): self {
    $this->message->setFrom($from, $name);
    
    return $this;
  }
  
  /**
   * Send the message with the mailer
   * 
   * @return int
   */
  public function send() {
    
    return $this->mailer->send($this->message);
  }
  
  /**
   * Set the mailer with correct configuration
   * 
   * @param ContainerInterface $container
   */
  private function setMailer(ContainerInterface $container) {
    $transport = new Swift_SmtpTransport();
    
    if ($container->get('env') === 'prod') {
      $transport->setHost($container->get('mail.host'));
      $transport->setPort($container->get('mail.port'));
      $transport->setUsername($container->get('mail.username'));
      $transport->setPassword($container->get('mail.password'));
      $transport->setAuthMode($container->get('mail.auth'));
      $transport->setEncryption($container->get('mail.encryption'));
    }
    
    if ($container->get('env') === 'dev') {
      $transport->setHost($container->get('mail.host'));
      $transport->setPort($container->get('mail.port'));
    }
    
    $this->mailer = new Swift_Mailer($transport);
  }
}
