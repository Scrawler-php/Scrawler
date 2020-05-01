<?php
/**
 * Scarawler core container
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

use Scrawler\Scrawler;

class Database extends \R{

    public function __construct(){
        self::setup('mysql:host='.Scrawler::engine()->config['database']['host'].';dbname='.Scrawler::engine()->config['database']['database'], Scrawler::engine()->config['database']['username'], Scrawler::engine()->config['database']['password']);
    }

    public function create($name){
        return self::dispense($name);
    }

    public function save($model){
        return self::store($model);
    }

    public function get($model,$id){
         return self::load($model,$id);
    }

    public function delete($model){
         return self::trash($model);
    }

//     public function find($model,$query=null,$binding=null){
//          return self::find($model,$query,$binding);
//     }

//     public function findOne($model,$query=null,$binding=null){
//         return self::find($model,$query,$binding);
//    }
}