<?php

namespace Portfolio\Core\Middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of TrailingSlashMiddleware
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TrailingSlashMiddleware {
  
  public function __invoke(ServerRequestInterface $request, callable $next) {
    $uri = $request->getUri()->getPath();
    
    if (!empty($uri) && substr($uri, -1) === '/' && $uri != '/') {
      return (new Response())
        ->withStatus(301)
        ->withHeader('Location', substr($uri, 0, -1));
    }
    
    return $next($request);
  }
  
}
