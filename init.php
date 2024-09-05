<?php
 include 'admin-control/connect.php';
      // ROUTES
 $tpl = 'includes/templates/'; // Template Directory
 $lang='includes/languages/'; //Languages Directory
 $func = 'includes/functions/';
 $css = 'layout/css/'; // CSS Directory
 $js = 'layout/js/'; // JS Directory
 
$sessionUser = '';
if(isset($_SESSION['user'])){
     $sessionUser = $_SESSION['user'];
}

 //Include The Important Files
 include $func . 'functions.php';

 include $lang . 'english.php';
//include $lang . 'arabic.php';
include $tpl . 'header.php';
//if(!isset($noNavbar)) {include $tpl . 'navbar.php';}

//include $tpl . 'navbar.php';





 