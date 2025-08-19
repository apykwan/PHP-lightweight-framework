<?php

use App\Controllers\{HomeController, BookController};

return [
  ['GET', '/', [HomeController::class, 'index']],
  ['GET', '/books/{id:\d+}', [BookController::class, 'show']]
];