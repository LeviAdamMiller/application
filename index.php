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
//run fat free
$f3->run();
