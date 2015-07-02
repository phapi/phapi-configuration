<?php

/*
 * Set up the dependency injection container
 */
$container = new \Phapi\Di\Container();

/*
 * Add validators for the dependency injection container so that the container can
 * validate that configured cache and log implements the need contracts.
 */
$container->addValidator('cache', new \Phapi\Di\Validator\Cache($container));
$container->addValidator('log', new \Phapi\Di\Validator\Log($container));
