<?php
namespace App\Middlewares;

return [

     'middlewares' => [   
     \Scrawler\Middleware\Csrf::class,
     // Demo::class,
     ],
     'api_middlewares' => [   
          // \Scrawler\Middleware\Csrf::class,
          // Demo::class,
     ]
];