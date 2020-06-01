<?php

return [

/**
 * General Configurations
 */
'general' => [
'env' => 'dev'
],

/**
 * Database Configuration
 */
'database'=>[

'host' => 'localhost',
'database' => 'scrawler',
'username' => 'root',
'password' => 'root',
'port' => '3306'

],

/**
 * If you are using memcached for caching
 */
'memcahe'=>[

'enabled'  => 0,
'host' => "127.0.0.1",
'port' => "11211",

],


/**
 * Mailer Configuration
 */
'mailer' => [

'host' => 'smtp1.example.com',
'secure' => 0,
'username' => 'user@example.com',
'password' =>'secret',
'port' => "587"

]

];