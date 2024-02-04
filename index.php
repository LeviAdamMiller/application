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
require_once ('vendor/autoload.php');

//instantiate Fat-Free framework
$f3 = Base::instance();

//define default route
$f3 ->route('GET /',function(){
    // display views page
    $view = new Template();
    echo $view->render('views/home.html');

});

//define default route
$f3 ->route('GET /personal',function(){
    // display views page
    $view = new Template();
    echo $view->render('views/personalInformation.html');

});

//define default route
$f3 ->route('GET|POST /experience',function($f3){
    // display views page
    $view = new Template();
    echo $view->render('views/experience.html');


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //validate the data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $state = $_POST["state"];


    // Put the data in the session array
    $f3->set('SESSION.firstName', $firstName);
    $f3->set('SESSION.lastName', $lastName);
    $f3->set('SESSION.email', $email);
    $f3->set('SESSION.phone', $phone);
    $f3->set('SESSION.state', $state);

    $f3->reroute('experience');
    }
});
//define default route
$f3 ->route('GET /JobOpenings',function(){
    // display views page
    $view = new Template();
    echo $view->render('views/jobOpenings.html');

});




//    //If the form has been posted
//    if($_SERVER['REQUEST_METHOD'] == 'POST'){
//        // Validate the data
//        if (isset($_POST['conds'])){
//            $conds = implode(", ", $_POST['conds']);
//        }
//        else {
//            $conds = "None selected";
//        }
//
//        // Put the data in the session array
//        $f3->set('SESSION.conds', $conds);
//
//        // Redirect to summary route
//        $f3->reroute('summary');
//    }




//run fat free
$f3->run();
