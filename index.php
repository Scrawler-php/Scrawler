<?php
include __DIR__.'/vendor/scrawler/framework/src/Slim.php';

if(\Scrawler\Slim::isSlim()){
    $slim = \Scrawler\Slim();
    echo $slim->dispatch();
}else{
    include __DIR__.'/vendor/autoload.php';
    include __DIR__.'/bootstrap.php';
}




