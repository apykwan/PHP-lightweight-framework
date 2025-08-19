<?php

namespace App\Controllers;

use Framework\Http\{Request, Response};

class BookController
{
  public function show($id): Response
  {
    $content = "<h1>Book {$id}</h1>";
    return new Response($content);
  }
}