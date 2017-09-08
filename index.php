<?php
//ini_set('display_errors', 1);
require_once 'load.php';
require_once 'core/Model.php';
require_once 'core/View.php';
require_once 'core/Controller.php';
require_once 'vendor/autoload.php';
$loader = new Loader();

spl_autoload_register([$loader, 'loadClass']);

$router = new core\Routing();

$router->execute();
?>    
