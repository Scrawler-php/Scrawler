<?php
/**
 * Scarawler Mailer Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

Class Mailer extends PHPMailer{

    function __construct(){

    }

    function __set($key,$value){
        if($key == 'to'){
            $this->addAddress($value);
        }
    }
    

}