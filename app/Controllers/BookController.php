<?php

namespace App\Controllers;

use Framework\Controllers\AbstractController;
use Framework\Http\Response;

class BookController extends AbstractController
{
  public function show($id): Response
  {
    return $this->render('book.html.twig', ['id' => $id]);
  }

  public function create(): Response
  {
    return $this->render('create-book.html.twig');
  }

  public function store(): Response
  {
    dd('here');
  }
}