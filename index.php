<?php
include __DIR__.'/rb-mysql.php';
include __DIR__.'/core/Service/Slim.php';

/**
 * Check for slim mode before loading framework
 */
if(\Scrawler\Service\Slim::isSlim()){
     $slim = new \Scrawler\Service\Slim();
     echo $slim->dispatch();
}else{
    include __DIR__.'/vendor/autoload.php';
    include __DIR__.'/core/Boot.php';
}

