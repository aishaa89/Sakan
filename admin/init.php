<?php
  include 'connect.php';

//Routes
$tpl = 'includes/templates/'; //templates directory
$lang = 'includes/languages/'; //language directory
$func = 'includes/functions/'; //function directory
$css = 'layout/css/';         //css directory
$js = 'layout/js/';           //js directory


    //include the important files

    include $func . 'functions.php';
    include $lang . 'english.php'; 
    include $tpl . 'header.php';
    //include navbar on all pages expect the one with $noNavbar variable
    if(!isset($noNavbar)) { include $tpl . 'navbar.php' ; }
 ?>   

    


