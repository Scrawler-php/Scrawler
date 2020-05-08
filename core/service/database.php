<?php
/**
 * Scarawler Database Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

use Scrawler\Scrawler;

class Database extends \R{

    public static function new(){
        self::setup('mysql:host='.Scrawler::engine()->config['database']['host'].';dbname='.Scrawler::engine()->config['database']['database'], Scrawler::engine()->config['database']['username'], Scrawler::engine()->config['database']['password']);
        return new Self();
    }

    public static function create($name){
        return self::dispense($name);
    }

    public static function save($model){
        return self::store($model);
    }



    public static function __callStatic($name, $arguments) { 
        if ($name == 'get') {
            if(count($arguments) == 2)
            return self::load($arguments[0], $arguments[1]);
            if(count($arguments) == 1)
            return self::findAll($arguments[0]);
        }
            return parent::__callStatic($name, $arguments);
        
    }

    public static function delete($model){
         return self::trash($model);
    }


}