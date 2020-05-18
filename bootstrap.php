<?php
/**
 * Bootstrap the scrawler kernel
 */
$app = new Scrawler\Scrawler(__DIR__);
$response=$app->handle(Scrawler\Service\Http\Request::createFromGlobals());
$response->send();
