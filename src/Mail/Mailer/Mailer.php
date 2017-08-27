<?php

namespace Tuxi\Portfolio\Mail\Mailer;

use Swift_Mailer;
use Swift_Message;
use Tuxi\Portfolio\Mail\Mailer\{
  MessageBuilder,
  MailableInterface
};
use Twig_Environment as Twig;

/**
 * Description of Mailer.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Mailer {
  
  /**
   * 
   * @var Swift_Mailer
   */
  protected $swift;
  
  /**
   *
   * @var Twig_Environment
   */
  protected $twig;
  
  /**
   *
   * @var array
   */
  protected $to = [];
  
  /**
   * Constructor.
   * 
   * @param Swift_Mailer $swift The Swift_Mailer instance.
   * @param Twig_Environment $twig The Twig_Environment instance.
   */
  public function __construct(Swift_Mailer $swift, Twig $twig) {
    $this->swift = $swift;
    $this->twig = $twig;
  }
  
  /**
   * Set the from address of this mailer.
   * 
   * @param string $address The address to set.
   * @param string|null $name The name to set, if any.
   * @return Tuxi\Portfolio\Mail\Mailer\PendingMailable
   */
  public function from($address, $name = null) {
    
    return (new PendingMailable($this))->from($address, $name);
  }
  
  /**
   * Set the default to address for this mailer.
   * 
   * @param string $address The address to set.
   * @param string|null $name The name to set, if any.
   * @return $this
   */
  public function alwaysTo($address, $name = null) {
    $this->to = compact('address', 'name');
    
    return $this;
  }
  
  /**
   * 
   * @param Tuxi\Portfolio\Mail\Mailer\MailableInterface $view
   * @param array $viewData
   * @param \Callable|null $callback
   * @return type
   */
  public function send($view, $viewData = [], Callable $callback = null) {
    if($view instanceof MailableInterface) {
      
      return $this->sendMailable($view);
    }
    
    $message = $this->buildMessage();
    
    call_user_func($callback, $message);
    
    $message->body($this->parseView($view, $viewData));
    
    return $this->swift->send($message->swiftMessage());
  }
  
  /**
   * Send a Mailable.
   * 
   * @param Tuxi\Portfolio\Mail\Mailer\Mailable $mailable The mailable instance.
   * @return Tuxi\Portfolio\Mail\Mailer\Mailable.
   */
  protected function sendMailable(Mailable $mailable) {
    
    return $mailable->send($this);
  }
  
  /**
   * Build the Message.
   * 
   * @return Tuxi\Portfolio\Mail\Mailer\MessageBuilder.
   */
  protected function buildMessage() {
    
    return (new MessageBuilder(new Swift_Message))
      ->to($this->to['address'], $this->to['name']);
  }
  
  /**
   * Parse the view.
   * 
   * @param Tuxi\Portfolio\Mail\Mailer\MailableInterface $view
   * @param array $viewData Array of data for the view.
   * @return Twig_Environment
   */
  protected function parseView($view, array $viewData = []) {
    
    return $this->twig->render($view, $viewData);
  }
  
}
