<?php
require_once 'Autoloader.php';

$loader = new Autoloader();

$loader->register();
$loader->addNamespace('App', 'app');
$loader->addNamespace('App\\Controller', 'app/controllers');
$loader->addNamespace('App\\Migration', 'app/database');
$loader->addNamespace('App\\Model', 'app/models');
$loader->addNamespace('ApiHelper', 'app/services');


require_once __DIR__. '/../config/config.php';
require_once __DIR__. '/../config/route.php';
require_once __DIR__. '/../config/migrate.php';