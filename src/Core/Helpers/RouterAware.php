<?php

namespace Portfolio\Core\Helpers;

use GuzzleHttp\Psr7\Response;
use Portfolio\Core\Routing\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Add methods related to the use of the router
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
trait RouterAware {
  
  public function getRouter() {
    
    return new Router();
  }
  
  /**
   * Returns a redirect response
   *
   * @param string $path
   * @param array $params
   * @return ResponseInterface
   */
  public function redirect(string $path, array $params = []): ResponseInterface {
    $redirectUri = $this->getRouter()->generateUri($path, $params);
      
    return (new Response())
      ->withStatus(301)
      ->withHeader('Location', $redirectUri);
  }
  
  /**
   * Redirects to the previous uri or "/"
   * Support for a hash in uri
   * eg. /home#contact
   * 
   * @param ServerRequestInterface $request
   * @param string $hash
   * @return ResponseInterface
   */
  public function redirectBack(ServerRequestInterface $request, string $hash = ''): ResponseInterface {
    $referer = $request->getServerParams()['HTTP_REFERER'] ?? '/';
    
    return new Response(301, ['Location' => $referer . $hash]);
  }
}
