<?php

namespace Framework\Http;
use Framework\Http\{Request, Response};
use FastRoute\{RouteCollector, Dispatcher};
use function FastRoute\simpleDispatcher;

class Kernel
{
  public function handle(Request $request): Response
  {
    $dispatcher = simpleDispatcher(function (RouteCollector $routeController) {
      $routes = include BASE_PATH . '/framework/routes/web.php';

      foreach($routes as $route) {
        $routeController->addRoute(...$route);
      }
    });

    $routeInfo = $dispatcher->dispatch(
      $request->getMethod(), 
      $request->getUri()
    );
    
    $status = $routeInfo[0];

    if ($status === Dispatcher::NOT_FOUND) {
      return new Response('<h1>404 Not Found</h1>', 404);
    }

    if ($status === Dispatcher::METHOD_NOT_ALLOWED) {
      return new Response('<h1>405 Method Not Allowed</h1>', 405);
    }

    // Only now $handler and $vars exist
    [$status, $handler, $vars] = $routeInfo;

    [$controller, $method] = $handler;

    return call_user_func_array([new $controller, $method], $vars);
  }
}