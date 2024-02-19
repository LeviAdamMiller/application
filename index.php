<?php
/*
Levi Miller
1/20/24
index.php: routing page so application is the default directory
*/
// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once('vendor/autoload.php');
require('model/validate.php');

//instantiate Fat-Free framework
$f3 = Base::instance();

//define default route
$f3->route('GET /', function () {
    // display views page
    $view = new Template();
    echo $view->render('views/home.html');

});

//define default route
$f3->route('GET|POST /personal', function ($f3) {


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!Validate::validName($_POST['firstName'])) {
            $f3->set('errors["firstName"]', "Invalid first name");
        }

        if (!Validate::validName($_POST['lastName'])) {
            $f3->set('errors["lastName"]', "Invalid last name");
        }

        if (!Validate::validEmail($_POST['email'])) {
            $f3->set('errors["email"]', "Invalid email");


            if (!Validate::validPhone($_POST['phone'])) {
                $f3->set('errors["phone"]', "Invalid Phone format");
            }
        }


        //validate the data
        // If there are no errors
        if (empty($f3->get('errors'))) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $state = $_POST['state'];
            // Put the data in the session array
            $f3->set('SESSION.firstName', $firstName);
            $f3->set('SESSION.lastName', $lastName);
            $f3->set('SESSION.email', $email);
            $f3->set('SESSION.phone', $phone);
            $f3->set('SESSION.state', $state);
            $f3->reroute('experience');
        }
    }

    // display views page
    $view = new Template();
    echo $view->render('views/personalInformation.html');
});

//define default route
$f3->route('GET|POST /experience', function ($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!Validate::validExperience($_POST['years'])) {
            $f3->set('errors["years"]', "Invalid Years ");
        }

        if (!Validate::validGithub($_POST['Github'])) {
            $f3->set('errors["Github"]', "Invalid Github Link");
        }

        if (empty($f3->get('errors'))) {
            // Validate the data
            $years = implode(", ", $_POST['years']);

            if (isset($_POST['relocate'])) {
                $relocate = implode(", ", $_POST['relocate']);
            } else {
                $relocate = "None selected";
            }

            $bio = $_POST['biography'];
            $git = $_POST['Github'];

            // Put the data in the session array
            $f3->set('SESSION.years', $years);
            $f3->set('SESSION.relocate', $relocate);
            $f3->set('SESSION.biography', $bio);
            $f3->set('SESSION.Github', $git);
            // Redirect to summary route
            $f3->reroute('JobOpenings');
        }
    }

    // display views page
    $view = new Template();
    echo $view->render('views/experience.html');


});
//define default route
$f3->route('GET|POST /JobOpenings', function ($f3) {


    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Validate the data
        if (isset($_POST['mail'])) {
            $mail = implode(", ", $_POST['mail']);
        } else {
            $mail = "None selected";
        }

        // Put the data in the session array
        $f3->set('SESSION.mail', $mail);

        // Redirect to summary route
        $f3->reroute('summary');
    }
    // display views page
    $view = new Template();
    echo $view->render('views/jobOpenings.html');

});

// Define an order summary route
$f3->route('GET /summary', function () {
    //echo "Thank you for your order!";

    // Display a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//run fat free
$f3->run();
