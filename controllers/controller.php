<?php

require_once 'classes/applicant.php';
require_once 'classes/Applicant_SubscribedToLists.php';


class Controller
{

    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


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
        $mailing = "No";

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

            if (isset($_POST['mailing'])) {
                $mailing = $_POST['mailing'];
            }

            $newApplicant = new Applicant();

            // Store data in the session array
            if (Validate::validName($fname)) {
                $newApplicant->setFName($fname);
            } else {
                $this->_f3->set('errors["fname"]', 'invalid, try again');
            }

            if (Validate::validName($lname)) {
                $newApplicant->setLName($lname);
            } else {
                $this->_f3->set('errors["lname"]', 'invalid, try again');
            }

            if (Validate::validEmail($email)) {
                $newApplicant->setEmail($email);
            } else {
                $this->_f3->set('errors["email"]', 'invalid, try again');
            }

            if (Validate::validPhone($phone)) {
                $newApplicant->setPhone($phone);
            } else {
                $this->_f3->set('errors["phone"]', 'invalid, try again');
            }

            $newApplicant->setState($state);
            $f3->set('SESSION.mailing', $mailing);

            // Redirect to experience form page
            if (empty($this->_f3->get('errors'))) {

                $this->_f3->set('SESSION.applicant', $newApplicant);
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
                $f3->get('SESSION.applicant')->setExperience($userExp);
            } else {
                $this->_f3->set('errors["yrExp"]', 'invalid, try again');
            }

            if (Validate::validGithub($git)) {
                $f3->get('SESSION.applicant')->setGitLink($git);
            } else {
                $this->_f3->set('errors["git"]', 'invalid, try again');
            }

            $f3->get('SESSION.applicant')->setBio($bio);
            $f3->get('SESSION.applicant')->setRelocate($relocate);

            // Redirect to openings form page
            if (empty($this->_f3->get('errors'))) {
                if ($f3->get('SESSION.mailing') == 'optIn') {
                    $f3->reroute('openings');
                } else {
                    $f3->reroute('summary');
                }
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

        $selectedIndV = array();
        $selectedSDJ = array();

        $applicantSubscription = new Applicant_SubscribedToLists();


        // If the form is posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // Get data
            if (!empty($_POST['sdj'])) {
                $selectedSDJ = $_POST['sdj'];

                if(Validate::validSelectionsJobs($selectedSDJ)) {
                    $applicantSubscription->setSelectionsJobs(implode(", ", $selectedSDJ));
                } else {
                    $this->_f3->set('errors["sdj"]', 'Go away, evildoer!');
                }
            } else {
                $applicantSubscription->setSelectionsJobs("");
            }

            if (!empty($_POST['indV'])) {
                $selectedIndV = $_POST['indV'];

                if(Validate::validSelectionsVerticals($selectedIndV)) {
                    $applicantSubscription->setSelectionsVerticals(implode(", ", $selectedIndV));
                } else {
                    $this->_f3->set('errors["indV"]', 'Go away, evildoer!');
                }
            } else {
                $applicantSubscription->setSelectionsVerticals("");
            }


            // Redirect to openings form page
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->set('SESSION.applicantSubscription', $applicantSubscription);
                $f3->reroute('summary');
            }

            $f3->clear('SESSION.sdj');
            $f3->clear('SESSION.indV');

        }

        // Get the data from the model and add to hive
        $f3->set('jobs', getJobs());
        $f3->set('verticals', getVerticals());

        // Display view page
        $view = new Template();
        echo $view->render('views/openingsForm.html');
    }

    function summary($f3)
    {
        // Display a view page
        $view = new Template();
        echo $view->render('views/summary.html');
    }
} // end class

