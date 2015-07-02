<?php

/*
 * This file contains default settings. Please note that overriding settings should
 * be done by adding the same setting in the app/configuration/settings.php file.
 */

/*
 * DO NOT EDIT ANY LINES BELOW
 */
$container['httpVersion'] = '1.1';          // HTTP Version
$container['charset'] = 'utf-8';            // Default charset

$container['contentTypes'] = [];            // Supported request content types (will be populated by deserializers)
$container['acceptTypes'] = [];             // Supported response content types (will be populated by serializers)

/*
 * Configure the request object
 */
$container['request'] = function ($container) {
    return \Zend\Diactoros\ServerRequestFactory::fromGlobals();
};

/*
 * Configure the response object
 */
$container['response'] = function ($container) {
    return new \Phapi\Http\Response();
};

/*
 * Configure default logging. This is needed to ensure that the application won't break
 * and to simplify development since the developer can take for granted that there will
 * always be a logger configured. The default logger is a "dummy" logger that acts like
 * a real logger but doesn't do anything.
 */
$container['log'] = function ($container) {
    return new \Psr\Log\NullLogger();
};

/*
 * Configure default cache. This is needed to ensure that the application won't break
 * and to simplify development since the developer can take for granted that there will
 * always be a cache configured. The default cache is a "dummy" cache that acts like
 * a real cache but doesn't do anything.
 */
$container['cache'] = function ($container) {
    return new \Phapi\Cache\NullCache();
};
