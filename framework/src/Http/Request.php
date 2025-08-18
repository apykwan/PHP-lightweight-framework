<?php

namespace Framework\Http;

class Request
{
  private static $instance = null;

  private function __construct(
    private array $server,
    private array $get,
    private array $post,
    private array $files,
    private array $cookie,
    private array $env,
  ){}

  public static function create(): static
  {
    if (null == static::$instance) {
      static::$instance = new static(
        $_SERVER,
        $_GET,
        $_POST,
        $_FILES,
        $_COOKIE,
        $_ENV
      );
    }

    return static::$instance;
  }
}