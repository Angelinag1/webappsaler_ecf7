<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Webappsaler\Models' => APP_PATH . '/modules/frontend/models/',
    'Webappsaler'        => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Webappsaler\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Webappsaler\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
