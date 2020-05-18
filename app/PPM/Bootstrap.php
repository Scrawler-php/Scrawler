<?php

namespace APP\PPM;

use PHPPM\Bootstraps\BootstrapInterface;
use PHPPM\Bootstraps\ApplicationEnvironmentAwareInterface;
use PHPPM\Bootstraps\RequestClassProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * A PHP-PM bootstrap for the Drupal framework.
 *
 * @see \PHPPM\Bootstraps\Symfony
 * @see \PHPPM\Bridges\HttpKernel
 */
class Bootstrap implements BootstrapInterface, ApplicationEnvironmentAwareInterface,  RequestClassProviderInterface

{
    /**
     * The PHP environment in which to bootstrap (such as 'dev' or 'production').
     *
     * @var string|null
     */
    protected $appenv;

    /**
     * @var boolean
     */
    protected $debug;

    /**
     * Instantiate the bootstrap, storing the $appenv
     *
     * @param string $appenv
     * @param boolean $debug
     */
    public function initialize($appenv, $debug)
    {
        $this->appenv = $appenv;
        $this->debug = $debug;
    }

     /**
     * {@inheritdoc}
     */
    public function requestClass()
    {
        return '\Scrawler\Service\Http\Request';
    }

    /**
     * Create a Drupal application.
     */
    public function getApplication()
    {
        //load drupals autoload.php, so their classes are available
        if (file_exists(__DIR__.'/../../vendor/autoload.php')) {
            $autoloader = require __DIR__.'/../../vendor/autoload.php';
        } 

        $app = new \Scrawler\Scrawler(__DIR__.'/../../');
        
        return $app;
    }
}