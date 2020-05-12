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

 /**
  *Generates url with bath
  */
  function url($path=''){
        return Scrawler\Scrawler::engine()->request()->getSchemeAndHttpHost().Scrawler\Scrawler::engine()->request()->getBasePath().$path;
  }

  /**
   * Returns request object
   */
  function request(){
       return Scrawler\Scrawler::engine()->request();
  }
