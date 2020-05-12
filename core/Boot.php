<?php

use Symfony\Component\HttpKernel\HttpKernel;
use Scrawler\Router\ArgumentResolver;
use Scrawler\Router\ControllerResolver;

//Register pritty error with whoops
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

//Build our main container
$scrawler = new Scrawler\Scrawler();

require __DIR__.'/Helper.php';

//Resolvers from the router component
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

//Finally get response from kernel
$kernel = new HttpKernel($scrawler->dispatcher(), $controllerResolver,null, $argumentResolver);

$response = $kernel->handle($scrawler->request());

$response->send();
