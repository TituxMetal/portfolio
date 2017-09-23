<?php

namespace Tuxi\Portfolio\Mail;

use Tuxi\Portfolio\Entity\Contact;
use Tuxi\Portfolio\Mail\Mailer\Mailable;

/**
 * Build a contact message to send.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ContactMessage extends Mailable {
  
  /**
   *
   * @var Tuxi\Portfolio\Entity\Contact
   */
  protected $contact;
  
  /**
   * Constructor.
   * 
   * @param Tuxi\Portfolio\Entity\Contact $contact The contact data.
   */
  public function __construct(Contact $contact) {
    $this->contact = $contact;
  }
  
  /**
   * Build the contact message to send.
   * 
   */
  public function build() {
    
    return $this->subject("New contact message is coming from {$this->contact->name()}")
      ->view('emails/contact.html.twig')
      ->with([
        'contact' => $this->contact
      ]);
  }
  
}
