<?php
 include 'connect.php';
      // ROUTES
 $tpl = 'includes/templates/'; // Template Directory
 $css = 'layout/css/'; // CSS Directory
 $js = 'layout/js/'; // JS Directory
 $lang='includes/languages/'; //Languages Directory


 //Include The Important Files

 include $lang . 'english.php';
//include $lang . 'arabic.php';
include $tpl . 'header.php';


//Include Navbar On All pages Expect The One With $noNavbar Variable 
if(!isset($noNavbar)) {include $tpl . 'navbar.php';}




 