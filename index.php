<!--
Author: Slavik Khrapach
Date: 4/22/2023
Description: This file turns on error reporting, Fat-Free, and creates a view
-->
<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    $view = new Template();

    //echo "<h1>TEST</h1>";
    echo $view->render('views/home.html');
});

$f3->route('GET /personal', function() {

    // Test
    //echo "<h1>TEST</h1>";

    // Display view page
    $view = new Template();
    echo $view->render('views/personalInfoForm.html');
});

$f3->route('GET /experience', function() {

    // Test
    //echo "<h1>TEST</h1>";

    // Display view page
    $view = new Template();
    echo $view->render('views/experienceForm.html');
});

$f3->route('GET /openings', function() {

    // Test
    //echo "<h1>TEST</h1>";

    // Display view page
    $view = new Template();
    echo $view->render('views/openingsForm.html');
});

$f3->route('GET /summary', function() {

    // Test
    //echo "<h1>TEST</h1>";

    // Display view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();
