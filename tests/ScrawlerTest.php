<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Scrawler\Scrawler;
use Symfony\Component\HttpFoundation\Request;
use Scrawler\Service\Database;
use Scrawler\Service\Module;
use Scrawler\Service\Template;
use Scrawler\Service\Cache;
use Scrawler\Service\Session;
use Scrawler\Service\Mailer;
use Scrawler\Router\RouteCollection;
use Scrawler\Router\RouterEngine;

class ScrawlerTest extends TestCase
{
  function  testInstanceOf(){
      $this->assertInstanceOf(Cache::class, Scrawler::engine()->cache());
      $this->assertInstanceOf(RouteCollection::class, Scrawler::engine()->router());
      $this->assertInstanceOf(Session::class, Scrawler::engine()->session());
      $this->assertInstanceOf(Template::class, Scrawler::engine()->template());
      $this->assertInstanceOf(Database::class, Scrawler::engine()->db());


  }
}