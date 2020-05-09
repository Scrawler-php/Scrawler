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

    /**
     * Initialize Readbead DB 
     * @return Database
     */
    public static function new(){
        self::setup('mysql:host='.Scrawler::engine()->config['database']['host'].';dbname='.Scrawler::engine()->config['database']['database'], Scrawler::engine()->config['database']['username'], Scrawler::engine()->config['database']['password']);
        return new Self();
    }

    /**
     * Create a Model
     * 
     * @param $name name of model
     * 
     * @return OODBBean bean instance
     */
    public static function create($name){
        return self::dispense($name);
    }
    
    /**
     * Save Model to database
     * 
     * @param OODBBean bean to save in your DB
     * 
     * @return int  id of stored object 
     */
    public static function save($model){
        return self::store($model);
    }


    /**
     * Overriding get method to either get single or all records
     * if get is called call this else call parent override
     * Example use db()::get('users')
     * 
     * @param string name of model 
     * @param int id of model to retrive
     * 
     * @return array|OODBBean all records matching query
     */
    public static function __callStatic($name, $arguments) { 
        if ($name == 'get') {
            if(count($arguments) == 2)
            return self::load($arguments[0], $arguments[1]);
            if(count($arguments) == 1)
            return self::findAll($arguments[0]);
        }
            return parent::__callStatic($name, $arguments);
        
    }

    /**
     *  Delete a record
     * 
     * @param OODBBean you want to remove from databse
     * 
     * @return void 
     */
    public static function delete($model){
         return self::trash($model);
    }


}