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

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    $view = new Template();

    echo $view->render('views/home.html');
});

$f3->route('GET|POST /personal', function($f3) {

    $fname = "";
    $lname = "";
    $email = "";
    $state = "";
    $phone = "";

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get data
        if (isset($_POST['fname'])) {
            $fname = $_POST['fname'];
        }

        if (isset($_POST['lname'])) {
            $lname = $_POST['lname'];
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if (isset($_POST['state'])) {
            $state = $_POST['state'];
        }

        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
        }

        // Store data in the session array
        if (validName($fname)) {
            $f3->set('SESSION.fname', $fname);
        } else {
            $f3->set('errors["fname"]', 'invalid, try again');
        }

        if (validName($lname)) {
            $f3->set('SESSION.lname', $lname);
        } else {
            $f3->set('errors["lname"]', 'invalid, try again');
        }

        if (validEmail($email)) {
            $f3->set('SESSION.email', $email);
        } else {
            $f3->set('errors["email"]', 'invalid, try again');
        }

        if (validPhone($phone)) {
            $f3->set('SESSION.phone', $phone);
        } else {
            $f3->set('errors["phone"]', 'invalid, try again');
        }

        $f3->set('SESSION.state', $state);

        // Redirect to experience form page
        if (empty($f3->get('errors'))) {
            $f3->reroute('experience');
        }
    }
    // Display view page
    $view = new Template();
    echo $view->render('views/personalInfoForm.html');
});

$f3->route('GET|POST /experience', function($f3) {

    $userExp = "";
    $relocate = "";
    $git = "";

    // If the form is posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['years-experience'])) {
            $userExp = $_POST['years-experience'];
        }

        if (isset($_POST['gitLink'])) {
            $git = $_POST['gitLink'];
        }

        // Get data
        $bio = $_POST['biography'];
        $relocate = $_POST['relocate'];


        // Store data in the session array
        if (validExperience($userExp)) {
            $f3->set('SESSION.yrExp', $userExp);
        } else {
            $f3->set('errors["yrExp"]', 'invalid, try again');
        }

        if (validGithub($git)) {
            $f3->set('SESSION.git', $git);
        } else {
            $f3->set('errors["git"]', 'invalid, try again');
        }

        $f3->set('SESSION.bio', $bio);
        $f3->set('SESSION.relocate', $relocate);


        // Redirect to openings form page
        if (empty($f3->get('errors'))) {
            $f3->reroute('openings');
        }
    }

    // Get the data from the model and add to hive
    $f3->set('experience', getExperience());

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
