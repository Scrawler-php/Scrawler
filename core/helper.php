<?php

/**
 * Helper function to return instance of scrawler
 * 
 * @return Object \Scrawler\Scrawler
 */
function s(){
 return Scrawler\Scrawler::engine(); 
}

/**
 * Render template  from template engine
 * 
 * @return String rendered body
 */
function view($file,$vars){
    return Scrawler\Scrawler::engine()->template()->render($file,$vars); 
 }