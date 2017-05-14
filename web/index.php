<?php

require_once __DIR__ . '/../vendor/autoload.php';

define('ROOT_PATH', __DIR__ . '/..');

$app = new Silex\Application();

require __DIR__ . '/../config/prod.php';

require __DIR__ . '/../src/app.php';

$app['http_cache']->run();
