<?php
/**
 * Scarawler Template Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

use Scrawler\Scrawler;
use eftec\bladeone\BladeOne;

class Template extends BladeOne
{
    public function __construct($view, $cache)
    {
        parent::__construct($view, $cache, BladeOne::MODE_AUTO);
    }

    /**
     * Render the template
     *
     * @param String $view to render
     * @param array $variables to pass to view
     */
    public function render($view, $variables=[])
    {
        return $this->run($view, $variables);
    }

    /**
     * Strips ('')  to  get the variable passed
     */
    private function strip($expression){
       return substr($expression,2,-2);
    }

    /**
     * Include css file from assets
     */
    public function compileCss($file){
          $file = $this->strip($file);
        return '<link rel="stylesheet" type="text/css" href="'.url('/assets/css/'.$file.'.css').'">';  
    }

    /**
     * Include js file from assets
     */
    public function compileJs($file){
        $file = $this->strip($file);
        return '<script src="'.url('/assets/js/'.$file.'.js').'"></script>';
    }

    /**
     * Get url of asset
     */
    public function compileAsset($file){
        $file = $this->strip($file);
        return url('/assets\/'.$file);
    }
}
