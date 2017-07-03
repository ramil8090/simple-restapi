<?php

require __DIR__ . '/vendor/autoload.php';

use MySimple\RestApp\Core\Application;
use MySimple\RestApp\Core\Configuration;

define('APP_ENVIRONMENT', 'production');
define('DEBUG_MODE', 1);

$config = __DIR__ . '/src/RestApp/Config/config.yml';
( new Application( new Configuration($config, __DIR__) ) )->run();