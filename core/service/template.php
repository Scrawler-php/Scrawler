<?php
/**
 * Scarawler Template Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

use Scrawler\Scrawler;
Use eftec\bladeone\BladeOne;

class Template extends BladeOne{

    function __construct($view,$cache){
        parent::__construct($view,$cache,BladeOne::MODE_AUTO);
    }

    function render($view,$variables=[]){
        return $this->run($view,$variables);
    }

    public function compileHello($expression=null)
    {
        if ($expression===null || $expression==='()') {
            return "<?php echo '--empty--'; ?>";
        }
        return "<?php echo 'Hello '.$expression; ?>";
    }
}