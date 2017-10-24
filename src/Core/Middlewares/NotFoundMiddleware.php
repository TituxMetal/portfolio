<?php

namespace Portfolio\Core\Middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of NotFoundMiddleware
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class NotFoundMiddleware {
  
  public function __invoke(ServerRequestInterface $request, callable $next) {
    
    return new Response(404, [], 'Erreur 404');
  }
  
}
