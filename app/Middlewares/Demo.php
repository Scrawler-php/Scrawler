<?php

namespace App\Middlewares;

use Scrawler\Interfaces\MiddlewareInterface; 

Class Hello implements MiddlewareInterface{

    public function run($request, $next){
        //Middleware logic goes here
        
        return $next($request);
    }

}