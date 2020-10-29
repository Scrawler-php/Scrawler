<?php
use Scrawler\Adapters\Storage\LocalAdapter;
use Scrawler\Adapters\Session\DatabaseAdapter;
use Scrawler\Adapters\Log\FileAdapter;

return  [
'StorageAdapter' => LocalAdapter::class,
'SessionAdapter' => DatabaseAdapter::class,
'LogAdapter'=> FileAdapter::class
];