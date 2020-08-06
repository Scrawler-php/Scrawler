<?php
use Scrawler\Adapters\Storage\LocalAdapter;
use Scrawler\Adapters\Session\DatabaseAdapter;

return  [
'storageAdapter' => LocalAdapter::class,
'sessionAdapter' => DatabaseAdapter::class
];