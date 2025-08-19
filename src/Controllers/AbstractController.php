<?php

namespace Framework\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Framework\Http\Response;

abstract class AbstractController
{
  public function render(string $template, ?array $vars = []): Response
  {
    $templatePath = BASE_PATH . '/views';
    $loader = new FilesystemLoader($templatePath);
    $twig = new Environment($loader);

    $content = $twig->render($template, $vars);

    return new Response($content);
  }
}