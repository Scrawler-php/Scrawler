<?php
/**
 * Scarawler Database Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

use Scrawler\Scrawler;
use RedBeanPHP\Finder;

class Database 
{
   private $toolbox;
   private $finder;

    /**
     * Initialize Readbead DB
     * @return Database
     */
    public function __construct()
    {
       \R::setup('mysql:host='.Scrawler::engine()->config['database']['host'].';dbname='.Scrawler::engine()->config['database']['database'], Scrawler::engine()->config['database']['username'], Scrawler::engine()->config['database']['password']);
       $t = \R::getToolBox(); 
       $this->toolbox = $t->getRedBean();
       $this->finder = new Finder( $t );
    }

    /**
     * Create a Model
     *
     * @param String name of model
     *
     * @return OODBBean bean instance
     */
    public function create($name)
    {
        return $this->toolbox->dispense($name);
    }
    
    /**
     * Save Model to database
     *
     * @param OODBBean bean to save in your DB
     *
     * @return int  id of stored object
     */
    public function save($model)
    {
        return $this->toolbox->store($model);
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
    public function __call($name, $arguments)
    {
        if ($name == 'get') {
            if (count($arguments) == 2) {
                return $this->toolbox->load($arguments[0], $arguments[1]);
            }
            if (count($arguments) == 1) {
                return $this->finder->find($arguments[0],NULL,[]);
            }
        }
        return \R::__callStatic($name, $arguments);
    }

    /**
     *  Delete a record
     *
     * @param OODBBean you want to remove from databse
     *
     * @return void
     */
    public  function delete($model)
    {
        return $this->toolbox->trash($model);
    }

    /**
     *  Delete multiple records
     *
     * @param OODBBean you want to remove from databse
     *
     * @return void
     */
    public function deleteAll($models)
    {
        return $this->toolbox->trashAll($models);
    }

    /**
     *  Find record
     */
    public function find($model,$query,$values=[]){
        return $this->finder->find($model,$query,$values);
    }

     /**
     *  Find single record
     */
    public function findOne($model,$query,$values=[]){
        return $this->finder->findOne($model,$query,$values);
    }


}
