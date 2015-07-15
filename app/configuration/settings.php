<?php

/*
 * Add your custom settings to this file. You can override any of the default settings
 * by adding them in this file. See the documentation for mor information about existing
 * application settings.
 */

 /*
  * Custom logging example. Please note that the Monolog package is NOT included by
  * default by Phapi. Please see the documentation for more information about how to
  * install the package. When the package is installed, uncomment the following lines
  * and modify them to match your needs.
  */
 //use Monolog\Logger;
 //use Monolog\Handler\StreamHandler;

 //$container['log'] = function ($container) {
     //$log = new Logger('default');

     // IMPORTANT! Make sure you use an absolute path. Relative paths aren't guaranteed to
     // work in some cases where errors and exceptions occur.
     //$log->pushHandler(new StreamHandler('/www/phapi/app/logs/logfile.log', Logger::WARNING));
     //return $log;
 //};

/*
 * Memcache example. Please note that the Memcache package is NOT included by default
 * by Phapi. Please see https://github.com/phapi/cache-memcache for more information
 * about how to install the package. When the package is installed, uncomment and modify
 * host and port (if needed).
 */
//$container['cache'] = function ($container) {
    //return new \Phapi\Cache\Memcache($servers = [
        //[
            //'host' => 'localhost',
            //'port' => 11211
        //]
    //]);
//};

/*
 * Redis example. Please note that the Redis Cache Provider is NOT included by default by
 * Phapi. Please see https://github.com/phapi/cache-redis for more information about how to
 * install the package. When the package is installed, uncomment and modify host and port
 * (if needed). Please note that this version of the Redis Cache Provider does NOT support
 * redis clusters.
 */
//$container['cache'] = function ($container) {
//    return new \Phapi\Cache\Redis\Redis($servers = [
//        [
//            'host' => 'localhost',
//            'port' => 6379,
//        ]
//    ]);
//};
