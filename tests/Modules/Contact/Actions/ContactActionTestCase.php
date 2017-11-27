<?php

namespace Tests\Modules\Contact\Actions;

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Sessions\SessionInterface;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Contact\Actions\ContactAction;
use Psr\Http\Message\ResponseInterface;
use Swift_Mailer;
use Swift_Message;

class ContactActionTestCase extends TestCase {

  /**
   * @var ContactAction
   */
  private $action;
  
  /**
   * @var FlashService
   */
  private $flash;
  
  /**
   * @var Swift_Mailer
   */
  private $mailer;
  
  /**
   * @var RendererInterface
   */
  private $renderer;
  
  /**
   * @var Router
   */
  private $router;
  
  /**
   * @var SessionInterface
   */
  private $session;
  
  /**
   * @var string
   */
  private $to = 'contact@demo.fr';
  
  public function setUp() {
    $this->flash = $this->getMockBuilder(FlashService::class)->disableOriginalConstructor()->getMock();
    $this->mailer = $this->getMockBuilder(Swift_Mailer::class)->disableOriginalConstructor()->getMock();
    $this->session = $this->getMockBuilder(SessionInterface::class)->getMock();
    $this->renderer = $this->getMockBuilder(RendererInterface::class)->getMock();
    $this->router = new Router();
    $this->action = new ContactAction(
      $this->flash,
      $this->mailer,
      $this->renderer,
      $this->router,
      $this->session,
      $this->to
    );
  }
  
  public function testPostInvalid() {
    $request = $this->makeRequest('/contact', [
      'name' => 'Jean-Marc',
      'email' => 'azeaze',
      'content' => 'azeazeaze'
    ]);
    
    $this->flash->expects($this->once())->method('error');
    $this->flash->expects($this->once())->method('messages');
    
    call_user_func($this->action, $request);
  }
  
  public function testPostValid() {
    $request = $this->makeRequest('/contact', [
      'contactName' => 'Jean-Marc',
      'contactEmail' => 'test@demo.fr',
      'contactSubject' => 'azeazeaze',
      'contactMessage' => 'azeazeaze'
    ]);
    
    $this->mailer
      ->expects($this->once())
      ->method('send')
      ->with($this->callback(function (Swift_Message $message) {
        $this->assertArrayHasKey($this->to, $message->getTo());
        $this->assertArrayHasKey('test@demo.fr', $message->getFrom());
        
        return true;
      })
    );
    $this->session->expects($this->once())->method('delete');
    $this->flash->expects($this->once())->method('success');
    
    $response = call_user_func($this->action, $request);
    
    
    $this->assertInstanceOf(ResponseInterface::class, $response);
  }
  
  protected function makeRequest(string $path, array $params = []) {
    $method = 'POST';
    
    return (new ServerRequest($method, new Uri($path)))
      ->withParsedBody($params);
  }
  
}
