<?php
/**
 * Scarawler ccache Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

use Scrawler\Scrawler;

Class Cache {

    /**
     * store memcache object
     */
    private $memcache;

    /**
     * stores the cache file location
     */
    private $location;

    /**
     * Constructor overload
     */
    function __construct(){
        if (Scrawler::engine()->config['memcahe']['enabled']) {
            $this->memcache = new \Memcached();
            $this->memcache->addServer("127.0.0.1", 11211);
        }
        $this->location = __DIR__.'/../../cache/core/';
    }

    /**
     * store data to cache
     * 
     * @param string $key the key to store
     * @param string $value the value to  store
     * 
     * @return boolean success value
     */
    function set($key,$value,$type='file'){

        if($type  == 'file'){
            return file_put_contents($this->location.$key.'.cache', serialize($value));
        }

         if ($type == 'memory' &&  Scrawler::engine()->config['memcahe']['enabled']) {
             return $memcache->set($key, $value);
         }

         return false;
    }

    /**
     * get data from memcache
     * 
     * @param string $key the key  to get data from
     * 
     * @return string value stored in memcache 
     */
    function get($key,$type = 'file'){

        if($type == 'memory' && Scrawler::engine()->config['memcahe']['enabled']) {
            return $memcache->get($key);
        }

        if($type == 'file'){
            return unserialize(file_get_contents($this->location.$key.'.cache'));
        }

        return false;

    }

}