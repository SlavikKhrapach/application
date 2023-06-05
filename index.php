<?php
/*
 * Slavik Khrapach
 * 4/8/2023
 * 328/application/index.php
 * Controller for application project
 *
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validation.php');
require_once('controllers/controller.php');


//Create an instance of the Base class
$f3 = Base::instance();

//Create an instance of the Controller class
$controller = new Controller();

//Define a default route
$f3->route('GET /', [$controller, 'home']);

$f3->route('GET|POST /personal', [$controller, 'personal']);

$f3->route('GET|POST /experience', [$controller, 'experience']);

$f3->route('GET|POST /openings', [$controller, 'openings']);

$f3->route('GET /summary', [$controller, 'summary']);

//Run fat free
$f3->run();