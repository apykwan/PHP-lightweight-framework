<?php

namespace App\Models;

use Framework\Database\Connection;

class Book
{
  private ?int $id = null;
  private string $title = '';
  private string $body = '';
  private Connection $connection;

  public function __construct() {
    $this->connection = Connection::getConnection();

    $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS books (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        body TEXT NOT NULL
    );
    SQL;

    $this->connection->pdo->exec($sql);
  }

  public function save(): void
  {
    $sql = <<<SQL
    INSERT INTO books (title, body)
    VALUES (:title, :body)
    SQL;
    $statement = $this->connection->pdo->prepare($sql);
    $statement->bindValue(':title', $this->getTitle());
    $statement->bindValue(':body', $this->getBody());
    $statement->execute();

    $id = $this->connection->pdo->lastInsertId();
    $this->setId($id);
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getTitle(): string 
  {
    return $this->title;
  }

  public function getBody(): string
  {
    return $this->body;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function setBody(string $body): void
  {
    $this->body = $body;
  }
}