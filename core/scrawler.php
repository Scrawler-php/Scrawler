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
use Symfony\Component\HttpFoundation\Request;

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
     * Initialize all the needed functionalities
     */
    public function __construct()
    {
        self::$scrawler = $this;
        $this->request = Request::createFromGlobals();
        $this->routeCollection = new RouteCollection(__DIR__.'/../modules/app/controllers', 'App\Controllers');
        $this->dispatcher = new EventDispatcher();
        $this->module = new Module();
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
     * Returns route collection object
     * @return Object RouteCollection
     */
    public function &router()
    {
        return $this->routeCollection;
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
     * @return Object Request
     */
    public function &request()
    {
        return $this->module;
    }
    /**
     * Returns scrawler class object
     * @return Object Scrawler\Scrawler
     */
    public static function engine()
    {
        return self::scrawler;
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
