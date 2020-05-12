<?php
/**
 * Scarawler ccache Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service\Http;

use Scrawler\Scrawler;

Class Request extends \Symfony\Component\HttpFoundation\Request{

   function __get($key){
       $value = $this->request->get($key);
       if($value == ''){
       $value = $this->query->get($key);
       }  
      return $value;
   }

   function all(){
       return array_merge($this->request->all(),$this->query->all());
   }

}