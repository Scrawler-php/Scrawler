<?php
use Scrawler\Adapters\Storage\LocalAdapter;
use Scrawler\Adapters\Session\DatabaseAdapter;

return  [
'storageAdapter' => StorageAdapter::class,
'sessionAdapter' => DatabaseAdapter::class
];