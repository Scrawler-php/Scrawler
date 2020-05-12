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
}
