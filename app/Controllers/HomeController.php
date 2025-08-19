<?php

namespace App\Controllers;

use Framework\Controllers\AbstractController;
use Framework\Http\Response;

class HomeController extends AbstractController
{
  public function index(): Response
  {
    return $this->render('home.html.twig');
  }
}