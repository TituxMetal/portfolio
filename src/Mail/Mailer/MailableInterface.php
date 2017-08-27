<?php

namespace Tuxi\Portfolio\Mail\Mailer;

use Tuxi\Portfolio\Mail\Mailer\Mailer;

/**
 * Description of MailableInterface
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
interface MailableInterface {
  
  /**
   * @param Tuxi\Portfolio\Mail\Mailer\Mailer $mailer
   */
  public function send(Mailer $mailer);
  
}
