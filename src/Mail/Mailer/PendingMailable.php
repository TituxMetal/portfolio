<?php

namespace Tuxi\Portfolio\Mail\Mailer;

use Tuxi\Portfolio\Mail\Mailer\{
  Mailer,
  Mailable
};

/**
 * Description of PendingMailable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class PendingMailable {
  
  /**
   *
   * @var Tuxi\Portfolio\Mail\Mailer\Mailer
   */
  protected $mailer;
  
  /**
   * Constructor.
   * 
   * @param Tuxi\Portfolio\Mail\Mailer\Mailer $mailer The Mailer instance.
   */
  public function __construct(Mailer $mailer) {
    $this->mailer = $mailer;
  }
  
  /**
   * Set the from address of this message.
   * 
   * @param string $address The address to set.
   * @param string|null $name The name to set, if any.
   */
  public function from($address, $name = null) {
    $this->from = compact('address', 'name');
    
    return $this;
  }
  
  /**
   * Send to the mailable.
   * 
   * @param Tuxi\Portfolio\Mail\Mailer\Mailable $mailable
   * @return Tuxi\Portfolio\Mail\Mailer\Mailable
   */
  public function send(Mailable $mailable) {
    $mailable->from($this->from['address'], $this->from['name']);
    
    return $this->mailer->send($mailable);
  }
  
}
