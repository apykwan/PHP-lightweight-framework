<?php

namespace Framework\Database;

use PDO;

class Connection 
{
  private static $instance = null;
  public ?PDO $pdo = null;

  private function __construct(string $connectionString)
  {
    $this->pdo = new PDO($connectionString);
  }

  public static function create(string $connectionString): static
  {
    if (static::$instance === null) {
      static::$instance = new static($connectionString);
    }
    return static::$instance;
  }

  public static function getConnection(): static
  {
    return static::$instance;
  }
}