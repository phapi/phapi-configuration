<?php

/*
 * Uncomment these lines during development. It enables easier debugging by
 * showing error messages. Please note that these lines should be uncommented
 * or removed in production.
 */
//error_reporting(E_ALL); // Show all errors
//ini_set('display_errors', true); // Display errors
//ini_set('opcache.enable', false); // Turn opcache off

/*
 * Set up composer auto loader. Make sure you run "composer dump-autoload --optimize --no-dev"
 * in production to optimize the auto loader and ignoring the development packages.
 */
require_once __DIR__ . '/../../vendor/autoload.php';

/*
 * Set up the dependency injection container used by the application.
 */
require_once __DIR__ . '/../configuration/default/container.php';

/*
 * Set up the middleware pipeline that handles the middleware and calls them
 * in the correct order as well as handling errors
 */
require_once __DIR__ . '/../configuration/default/pipeline.php';

/*
 * Configure the applications. First, load the default settings. Second,
 * override the default settings with any defined custom settings.
 */
require_once __DIR__ . '/../configuration/default/settings.php';
require_once __DIR__ . '/../configuration/settings.php';

/*
 * Load defined routes. These will be passed to the router middleware and
 * any other middleware that needs the route table.
 */
require_once __DIR__ . '/../configuration/routes.php';

/*
 * Configure the middleware pipeline and add the middleware that the application
 * should execute.
 */
require_once __DIR__ . '/../configuration/middleware.php';

/*
 * Run the application by starting the middleware pipeline. Include a request and a response
 * that will be passed to the middleware in the pipeline as well as the dispatched endpoint.
 */
$pipeline($container['request'], $container['response']);

/**********************************************************************************************
 * IMPORTANT !!!!
 **********************************************************************************************
 * Code after this line will be executed but PLEASE NOTE that it is important that no output
 * is sent to the client since the application already sent it's response while the pipeline
 * was executed. It is however possible to execute code after this line if you for example want
 * to do some logging or similar.
 */
