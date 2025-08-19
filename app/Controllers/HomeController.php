<?php

namespace App\Controllers;

use Framework\Http\{Request, Response};

class HomeController
{
  public function index(): Response
  {
    $content = "<h1>HELLO WORLD</h1>";
    return new Response($content);
  }
}