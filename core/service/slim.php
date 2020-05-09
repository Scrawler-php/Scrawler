<?php
/**
 * Class contains code for loading data during slim mode
 * Slim mode is activate when url starts with /api
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */
namespace Scrawler\Service;

use R;

Class Slim {
    /**
     * Array too store request path info 
     */
    private $path_info;

    /**
     * stores the request method
     */
    private $method;

    /**
     * Stores model
     */
    private $model;

    /**
     * Initialization tasks
     */
    function __construct(){
       $config =  parse_ini_file(__DIR__."/../../config.ini",true);
       R::setup('mysql:host='.$config['database']['host'].';dbname='.$config['database']['database'], $config['database']['username'], $config['database']['password']);
       $this->path_info = explode('/', $_SERVER['REQUEST_URI']);
       array_shift($this->path_info);
       $this->method = $_SERVER['REQUEST_METHOD'];
       if(isset($this->path_info[1])){
        $this->model = $this->path_info[1];
       }else{
         $this->model = false;
       }
    }

    /**
     * Function detects wether slim mode should activate
     * 
     * @return boolean
     */
    public static function isSlim(){
        if(explode('/', $_SERVER['REQUEST_URI'])[1]=='api'){
            return true;
        }
        else{
            return  false;
        }
    }

    /**
     * Function to send back response from slim mode
     * 
     * @return json response json
     */
    public function dispatch(){
        if(!$this->model){
            return json_encode(['error'=>'not found']);
        }
        if($this->method == 'GET'){
            return json_encode($this->get());
        }
        if($this->method == 'POST' && count($this->path_info) == 2){
            return json_encode(['id'=>$this->post()]);
        }
        if($this->method == 'POST' && count($this->path_info) == 3){
            return json_encode([$this->post()]);
        }
        if($this->method == 'DELETE'){
            $this->delete();
            return json_encode(['sucess'=> 'delete query executed' ]);
        }

    }

    /**
     * Function to resolve get query
     */
    private function get(){
        if(count($this->path_info)==3){
            return R::load($this->model, $this->path_info[2]);
        }
        if(count($this->path_info)==2){
            return R::findAll($this->model);
        }
        return json_encode(['error'=>'not found']);
    }
    
    /**
     * Function to resolve post query
     */
    private function post(){
        if(count($this->path_info)==3 && $this->path_info[2] == 'find'){
            return $this->find();
        }

        $model = R::dispense($this->model);
        foreach($_POST as $property => $value){
            $model->$property = $value;
        }
        return R::store($model);
    }

    /**
     * Function to resolve delete query
     */
    private function delete(){
        if (count($this->path_info)==3) {
            $model = R::load($this->model, $this->path_info[2]);
            R::trash($model);
        }
        if (count($this->path_info)==2) {
            return R::wipe($this->model);
        }
    }

    /**
     * Function to resolve find query
     */
    private function find(){
        foreach($_POST as $var=>$query){
            return R::find( $this->model, $query,[ $var] );
        }
    }


    }
