<?php

require_once('model/validation.php');

class Controller
{


    //F3 object

    function home()
    {
        // Display a view page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function personal($f3)
    {
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
            if (Validate::validName($fname)) {
                $f3->set('SESSION.fname', $fname);
            } else {
                $f3->set('errors["fname"]', 'invalid, try again');
            }

            if (Validate::validName($lname)) {
                $f3->set('SESSION.lname', $lname);
            } else {
                $f3->set('errors["lname"]', 'invalid, try again');
            }

            if (Validate::validEmail($email)) {
                $f3->set('SESSION.email', $email);
            } else {
                $f3->set('errors["email"]', 'invalid, try again');
            }

            if (Validate::validPhone($phone)) {
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
    } // end personal method

    function experience($f3)
    {
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
            if (Validate::validExperience($userExp)) {
                $f3->set('SESSION.yrExp', $userExp);
            } else {
                $f3->set('errors["yrExp"]', 'invalid, try again');
            }

            if (Validate::validGithub($git)) {
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
        $f3->set('relocateOptions', getRelocateOptions());

        // Display view page
        $view = new Template();
        echo $view->render('views/experienceForm.html');
    } // end experience method

    function openings($f3)
    {
        $selectedSDJ = array();
        $selectedIndV = array();

        // If the form is posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // Get data
            if (!empty($_POST['sdj'])) {
                $selectedSDJ = $_POST['sdj'];

                if(Validate::validSelectionsJobs($selectedSDJ)) {
                    $f3->set('SESSION.sdj', implode(", ", $selectedSDJ));
                } else {
                    $f3->set('errors["sdj"]', 'Go away, evildoer!');
                }
            }

            if (!empty($_POST['indV'])) {
                $selectedIndV = $_POST['indV'];

                if(Validate::validSelectionsVerticals($selectedIndV)) {
                    $f3->set('SESSION.indV', implode(", ", $selectedIndV));
                } else {
                    $f3->set('errors["indV"]', 'Go away, evildoer!');
                }
            }


            // Redirect to openings form page
            if (empty($f3->get('errors'))) {
                $f3->reroute('summary');
            }

        }

        // Get the data from the model and add to hive
        $f3->set('jobs', getJobs());
        $f3->set('verticals', getVerticals());

        // Display view page
        $view = new Template();
        echo $view->render('views/openingsForm.html');
    }

    function summary()
    {
        // Display a view page
        $view = new Template();
        echo $view->render('views/summary.html');
    }
} // end class

