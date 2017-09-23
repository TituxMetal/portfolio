<?php

namespace Tuxi\Portfolio\Mail\Mailer;

use Tuxi\Portfolio\Mail\Mailer\{
  MailableInterface,
  Mailer
};

/**
 * Description of Mailable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
abstract class Mailable implements MailableInterface {
  
  /**
   * @var array
   */
  protected $from = [];
  
  /**
   * @var string
   */
  protected $subject;
  
  /**
   * @var array
   */
  protected $to = [];
  
  /**
   *
   * @var type 
   */
  protected $view;
  
  /**
   *
   * @var array
   */
  protected $viewData = [];

  /**
   * Sends a message.
   * 
   * @param Tuxi\Portfolio\Mail\Mailer\Mailer $mailer
   */
  public function send(Mailer $mailer) {
    $this->build();
    
    $mailer->send($this->view, $this->viewData, function(MessageBuilder $message) {
      $message->from($this->from['address'], $this->from['name'])
        ->subject($this->subject);
      
      if($this->to) {
        $message->to($this->to['address'], $this->to['name']);
      }
    });
  }
  
  /**
   * Set the from address of this mailable.
   * 
   * @param string $address The address to set.
   * @param string|null $name The name to set, if any.
   * @return $this.
   */
  public function from($address, $name = null) {
    $this->from = compact('address', 'name');
    
    return $this;
  }
  
  /**
   * Set the subject of this mailable.
   * 
   * @param string $subject The subject to set.
   * @return $this.
   */
  public function subject($subject) {
    $this->subject = $subject;
    
    return $this;
  }
  
  /**
   * Set the to address of this mailable.
   * 
   * @param string $address The address to set.
   * @param name|null $name The name to set, if any.
   * @return $this
   */
  public function to($address, $name = null) {
    $this->to = compact('address', 'name');
    
    return $this;
  }
  
  /**
   * Set the view name.
   * 
   * @param string $view The view to use.
   * @return $this.
   */
  public function view($view) {
    $this->view = $view;
    
    return $this;
  }
  
  /**
   * The data for the view.
   * 
   * @param array $viewData An array of data to pass to the view.
   * @return $this
   */
  public function with( array $viewData = []) {
    $this->viewData = $viewData;
    
    return $this;
  }
  
}
