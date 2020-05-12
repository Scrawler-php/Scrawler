<?php
/**
 * Scarawler core container
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler;

use Scrawler\Router\RouteCollection;
use Scrawler\Router\RouterEngine;
use Scrawler\Scrawler;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Response;
use Scrawler\Service\Database;
use Scrawler\Service\Module;
use Scrawler\Service\Template;
use Scrawler\Service\Cache;
use Scrawler\Service\Session;
use Scrawler\Service\Mailer;
use Scrawler\Service\Http\Request;


class Scrawler
{
    /**
     * Stores class static instance
     */
    public static $scrawler;

    /**
    * Stores the request being processed
    */
    private $request;
    /**
     * Route Collection Object
     */
    private $routeCollection;

    /**
     * Stores the event dispatcher object
     */
    private $dispatcher;

    /**
     * Stores the module object
     */
    private $module;

    /**
     * Stores the database
     */
    private $db;

    /**
     * Stores cache object
     */
    private $cache;

    /**
     * Stores the configuration form config.ini
     */
    public $config;

    /**
     * Stores the template
     */
    private  $template;


    /**
     * Stores the session
     */
    private  $session;
    

    /**
     * Stores the mailer
     */
    private  $mailer;


    /**
     * Initialize all the needed functionalities
     */
    public function __construct()
    { 
        $this->config = parse_ini_file(__DIR__."/../config.ini",true);
        self::$scrawler = $this;
        $this->cache = new Cache();
        $this->request = Request::createFromGlobals();
        $this->db = new Database();
        $this->routeCollection = new RouteCollection(__DIR__.'/../app/controllers', 'App\Controllers');
        $this->dispatcher = new EventDispatcher();
        $this->module = new Module();
        $this->session  = new Session('kfenkfhcnbejd');
        $this->mail = new Mailer(true);
        //templateing engine
        $views = __DIR__ . '/../app/views';
        $cache = __DIR__ . '/../cache/templates';
        $this->template = new Template($views,$cache);

        $this->registerCoreListners();
    }

    /**
     * returns the event dispatcher object
     * @return Object EventDispatcher
     */
    public function &dispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * returns cache object
     * @return Object \Scrawler\Service\Cache
     */
    public function &cache()
    {
        return $this->cache;
    }

    /**
     * Returns route collection object
     * @return Object RouteCollection
     */
    public function &router()
    {
        return $this->routeCollection;
    }

    /**
     * Returns session object
     * @return Object RouteCollection
     */
    public function &session()
    {
        return $this->session;
    }

    /**
     * Returns request object
     * @return Object Request
     */
    public function &request()
    {
        return $this->request;
    }

    /**
     * Returns module object
     * @return Object \Scrawler\Service\Module
     */
    public function &module()
    {
        return $this->module;
    }

    /**
     * Returns database object
     * @return Object \Scrawler\Service\Database
     */
    public function &db(){
        return $this->db;
    }
    
    /**
     * Returns mailer object
     * @return Object \Scrawler\Service\Mailer
     */
    public function &mailer(){
        return $this->mailer;
    }

    /**
     * Returns templating engine object
     * @return Object \Scrawler\Service\Template
     */
    public function &template(){
        return $this->template;
    }


    /**
     * Returns scrawler class object
     * @return Object Scrawler\Scrawler
     */
    public static function &engine()
    {
        return self::$scrawler;
    }



    /**
     * Register few core event listners
     * @return null
     */
    private function registerCoreListners()
    {
        //Add the route listner
        $this->dispatcher->addListener('kernel.request', function (Event $event) {
            $request=$event->getRequest();
            $engine = new RouterEngine($request, $this->routeCollection);
            $engine->route();
        });

        //Generate response from controller returned value
        $this->dispatcher->addListener('kernel.view', function (Event $event) {
            if (!$event->hasResponse()) {
                $response = new Response('Content', Response::HTTP_OK, array('content-type' => 'text/html'));
                $response->setContent($event->getControllerResult());
                $event->setResponse($response);
            }
        });
    }


}
