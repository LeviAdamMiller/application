<?php
// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once ('vendor/autoload.php');

//instantiate Fat-Free framework
$f3 = Base::instance();

//define default route
$f3 ->route('GET /',function(){
    // echo "My Diner";

    //display views page
    $view = new template();
    echo $view->render('views/home.html');
});
//run fat free
$f3->run();
