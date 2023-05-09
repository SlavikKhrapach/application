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

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    $view = new Template();

    echo $view->render('views/home.html');
});

$f3->route('GET|POST /personal', function($f3) {

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];

        // Store data in the session array
        $f3->set('SESSION.fname', $fname);
        $f3->set('SESSION.lname', $lname);
        $f3->set('SESSION.email', $email);
        $f3->set('SESSION.state', $state);
        $f3->set('SESSION.phone', $phone);

        // Redirect to experience form page
        $f3->reroute('experience');
    }
    // Display view page
    $view = new Template();
    echo $view->render('views/personalInfoForm.html');
});

$f3->route('GET|POST /experience', function($f3) {

    // If the form is posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get data
        $bio = $_POST['biography'];
        $git = $_POST['gitLink'];
        $yrExp = $_POST['years-experience'];
        $relocate = $_POST['relocate'];

        // Store data in the session array
        $f3->set('SESSION.bio', $bio);
        $f3->set('SESSION.git', $git);
        $f3->set('SESSION.yrExp', $yrExp);
        $f3->set('SESSION.relocate', $relocate);


        // Redirect to openings form page
        $f3->reroute('openings');
    }
    // Display view page
    $view = new Template();
    echo $view->render('views/experienceForm.html');
});

$f3->route('GET|POST /openings', function($f3) {

    // If the form is posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get data
        $sdj = implode(", ", $_POST['sdj']);
        $indV = implode(", ", $_POST['indV']);



        // Store data in the session array
        $f3->set('SESSION.sdj', $sdj);
        $f3->set('SESSION.indV', $indV);


        // Redirect to openings form page
        $f3->reroute('summary');
    }
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
