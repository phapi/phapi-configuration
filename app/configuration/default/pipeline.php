<?php

/*
 * Configure the middleware pipeline that the application will be using
 */
$container['pipeline'] = function ($container) {
    return new \Phapi\Middleware\Pipeline($container);
};

$pipeline = $container['pipeline'];
