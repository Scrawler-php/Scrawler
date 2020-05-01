<?php
/**
 * Handles modules
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */
namespace Scrawler\Service;

use Scrawler\Scrawler;

class Module
{
    private $modules;
    private $currentModule;

    public function register($name, $namespace, $directory)
    {
        $this->modules[$name]= array($namespace,$directory);
    }

    public function load($name)
    {
        $this->currentModule = $name;
        return $this;
    }

    public function registerRoutes()
    {
        $files = array_slice(scandir($this->modules[$currentModule][2]), 2);
        foreach ($files as $file) {
            if ($file != 'Main.php') {
                Scrawler::engine()->router()->registerController(\basename($file, '.php'), $this->modules[$currentModule][1] . '\\' . \basename($file, '.php'));
            }
        }
    }
}
