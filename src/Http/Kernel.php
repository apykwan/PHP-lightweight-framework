<?php

namespace Framework\Http;

use FastRoute\{RouteCollector, Dispatcher};
use function FastRoute\simpleDispatcher;

use Framework\Controllers\AbstractController;
use Framework\Database\Connection;

class Kernel
{
  protected ?Connection $connection = null;
  public function __construct()
  {
    $config = include BASE_PATH . '/database/config.php';
    $this->connection = Connection::create($config['connectionString']);
  }

  public function handle(Request $request): Response
  {
    $dispatcher = simpleDispatcher(function (RouteCollector $routeController) {
      $routes = include BASE_PATH . '/routes/web.php';

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
    $controller = new $controller;

    if ($controller instanceof AbstractController) {
      $controller->setRequest($request);
    }
    // e.g. controller.show(1)
    return call_user_func_array([$controller, $method], $vars);
  }
}