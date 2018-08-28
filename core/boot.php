<?php

use Symfony\Component\HttpKernel\HttpKernel;
use Scrawler\Router\ArgumentResolver;
use Scrawler\Router\ControllerResolver;

//Build over main container
$scrawler = new Scrawler\Scrawler();


//Resolvers from the router component
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

//Finally get response from kernel
$kernel = new HttpKernel($scrawler->dispatcher(), $controllerResolver,null, $argumentResolver);

$response = $kernel->handle($scrawler->request());

$response->send();
