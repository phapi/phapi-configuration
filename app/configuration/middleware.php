<?php

/*
 * Middleware
 *
 * PLEASE NOTE that the order of the middleware are very important! The middleware
 * are called in the order they are added to the pipeline. However, since the middleware
 * calls the next middleware during invoking they might execute code after the rest
 * of the queue is called.
 *
 * For a better visualisation of how the pipeline is handled see it as the first
 * middleware is called first AND last. While the middleware added last are called
 * in the middle.
 *
 * Example: the Serializers are added in the beginning of the pipeline but they wont
 * do anything until the remaining pipeline has been executed.
 */

/*
 * Courier middleware sends the response to the client, so the middleware must be the
 * last thing that's executed. Therefor it must be added first to the pipeline.
 */
$pipeline->pipe(new \Phapi\Middleware\Courier\Courier());

/*
 * Serializer middleware serializers the response body to the format that the client prefers
 */
$pipeline->pipe(new \Phapi\Middleware\Serializer\Json\Json());

/*
 * The following serializers are NOT installed by default. See the documentation for
 * more information about how to install them before uncommenting the line(s) below.
 */
//$pipeline->pipe(new \Phapi\Middleware\Serializer\Yaml\Yaml());
//$pipeline->pipe(new \Phapi\Middleware\Serializer\Xml\Xml());
//$pipeline->pipe(new \Phapi\Middleware\Serializer\Jsonp\Jsonp());

/*
 * Mistake middleware is an error handler. Serializer will serialize the error
 * message and Courier will return it to the client.
 */
$pipeline->pipe(new \Phapi\Middleware\Mistake\Mistake($displayErrors = true));

/*
 * UUID middleware generates and adds an UUID to the request and response. The UUID can
 * then be used while logging and makes it easier to debug if a client has problems.
 */
$pipeline->pipe(new \Phapi\Middleware\Uuid\Uuid());

/*
 * Method override middleware adds support for overriding the HTTP Verb. Good to have if
 * some clients are restricted to GET and POST.
 */
$pipeline->pipe(new \Phapi\Middleware\MethodOverride\MethodOverride());

/*
 * Format negotiation middleware negotiates the content type that the client requests.
 * If the requested content type isn't supported an error message will be returned.
 */
$pipeline->pipe(new \Phapi\Middleware\ContentNegotiation\FormatNegotiation());

/*
 * Route middleware includes both a router and a dispatcher that takes the request uri
 * and matches it against the route table. If a match is found the dispatcher dispatches
 * the request to the correct endpoint. Else a 404 Not Found will be sent to the client.
 * The dispatcher is added later to the pipeline (see below).
 */
$routeMiddleware = new \Phapi\Middleware\Route\Route(
    // Add the router to the middleware
    new \Phapi\Middleware\Route\Router(
        // A route parser is needed
        new \Phapi\Middleware\Route\RouteParser(),
        // Add the configured cache
        $container['cache']
    )
);
// Add defined routes to the router
$routeMiddleware->addRoutes($routes);

// Add the route middleware to the pipeline
$pipeline->pipe($routeMiddleware);

/*
 * PostBox middleware validates that any content included in the request can be
 * handled by the application.
 */
$pipeline->pipe(new \Phapi\Middleware\PostBox\PostBox());

/*
 * Deserializer middleware that deserializes any content provided in the request.
 */
$pipeline->pipe(new \Phapi\Middleware\Deserializer\Json\Json());

/*
 * The following serializers are NOT installed by default. See the documentation for
 * more information about how to install them before uncommenting the line(s) below.
 */
//$pipeline->pipe(new \Phapi\Middleware\Deserializer\Yaml\Yaml());
//$pipeline->pipe(new \Phapi\Middleware\Deserializer\Xml\Xml());

/*
 * This is where you usualy add new middleware to the pipeline. Please note that this
 * might differ depending on the functionality of the middleware. There is no golden
 * rule that fits all middleware. You have to figure out in what order the different
 * middleware should execute.
 */

/*
 * Cross-site HTTP requests are HTTP requests for endpoints from a different domain
 * than the domain of the resource making the request. Also called HTTP access control
 * or CORS. See https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
 * for more information about how CORS works.
 *
 * This middleware are NOT installed by default. See the documentation for more information
 * about how to install it before uncommenting these lines below.
 */
//$corsOptions = [
//    'allowedOrigins' => ['*'],
//    'allowedMethods' => ['*'],
//    'allowedHeaders' => ['*'],
//    'exposedHeaders' => [],
//    'maxAge' => 3600,
//    'supportsCredentials' => false,
//];
//$pipeline->pipe(new \Phapi\Middleware\Cors\Cors($corsOptions));

/*
 * Rate limit middleware limiting the amount of requests a client can do.
 *
 * This middleware are NOT installed by default. See the documentation for more information
 * about how to install it before uncommenting these lines below.
 */
//$rateLimitBuckets = [
//    'default' => new \Phapi\Middleware\RateLimit\Bucket(),
//];
//$pipeline->pipe(new \Phapi\Middleware\RateLimit\RateLimit(
//    'Client-ID',
//    $rateLimitBuckets,
//    $container['cache']
//));

/*
 * Add the dispatcher to the pipeline. The dispatcher middleware is part of
 * the Route middleware and the Route middleware is added earlier to the
 * pipeline (see above).
 */
$pipeline->pipe(new \Phapi\Middleware\Route\Dispatcher());
