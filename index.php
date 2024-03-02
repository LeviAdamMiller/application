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


//instantiate Fat-Free framework
$f3 = Base::instance();
$con = new controller($f3);

//define default route
$f3->route('GET /', function () {
    $GLOBALS['con']->home();
});

//define default route
$f3->route('GET|POST /personal', function ($f3) {
    $GLOBALS['con']->personalInformation();
});

//define default route
$f3->route('GET|POST /experience', function ($f3) {
    $GLOBALS['con']->experience();

});
//define default route
$f3->route('GET|POST /JobOpenings', function ($f3) {
    $GLOBALS['con']->jobOpenings();
});

// Define an order summary route
$f3->route('GET /summary', function () {
    $GLOBALS['con']->summary();
});

//run fat free
$f3->run();
