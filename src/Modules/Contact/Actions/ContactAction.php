<?php

namespace Portfolio\Modules\Contact\Actions;

use Portfolio\Core\Helpers\RouterAware;
use Portfolio\Core\Mail\Message;
use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Sessions\SessionInterface;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Core\Validation\Validator;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of ContactAction
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ContactAction {

  use RouterAware;

  /**
   * @var ContainerInterface
   */
  private $container;
  
  /**
   * @var FlashService
   */
  private $flash;
  
  /**
   * @var string[]
   */
  private $message = [
    'success' => 'Votre message a bien été envoyé.',
    'error' => 'Veuillez corriger les erreurs dans le formulaire.'
  ];

  /**
   * @var RendererInterface
   */
  private $renderer;
  
  /**
   * @var SessionInterface
   */
  private $session;
  
  /**
   * @var string
   */
  private $to;
  
  public function __construct(
      ContainerInterface $container,
      FlashService $flash,
      RendererInterface $renderer,
      SessionInterface $session,
      string $to
    ) {
    $this->container = $container;
    $this->flash = $flash;
    $this->renderer = $renderer;
    $this->session = $session;
    $this->to = $to;
  }
  
  public function __invoke(ServerRequestInterface $request) {
    $validator = $this->getValidator($request);
    
    if (!$validator->isValid()) {
      $errors = $validator->getErrors();
      $this->session->set('contactValues', $request->getParsedBody());
      $this->flash->messages($errors);
      $this->flash->error($this->message['error']);

      return $this->redirectBack($request, '#contact');
    }
    
    if ($this->sendMessage($request)) {
      $this->session->delete('contactValues');
      $this->flash->success($this->message['success']);

      return $this->redirectBack($request, '#contact');
    }
  }
  
  /**
   * Send a message
   * 
   * @param ServerRequestInterface $request
   * @return Message
   */
  private function sendMessage(ServerRequestInterface $request) {
    $params = $request->getParsedBody();
    
    return (new Message($this->container))
      ->addSubject('Formulaire de contact')
      ->addBody($this->renderer->render('@contact/email/contactText', $params))
      ->addPart($this->renderer->render('@contact/email/contactHtml', $params), 'text/html')
      ->addTo($this->to)
      ->addFrom($params['contactEmail'])
      ->send();
  }
  
  /**
   * Get the validator
   * 
   * @param ServerRequestInterface $request
   * @return Validator
   */
  private function getValidator(ServerRequestInterface $request) {
    
    return (new Validator($request->getParsedBody()))
      ->length('contactName', 5)
      ->length('contactSubject', 5)
      ->length('contactMessage', 5)
      ->email('contactEmail')
      ->notEmpty('contactName', 'contactEmail', 'contactSubject', 'contactMessage');
  }
  
}
