<?php

  /*
     Categories => [manage | edit | update | add | insert | delet | stats ]
      condition ? true : fale

 */
 
 $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
   echo $do;

  /* if(isset($_GET['do'])){
         $do = $_GET['do'];
     }else{
        $do = 'Manage';
     }*/
   //if the page is main page 
   if($do == 'manage'){
         echo 'welcome you are in manage categories page ';
         echo '<a href="page.php?do=Add"> Add New Category +</a>';
    }elseif($do == 'Add'){
         echo "welcome You are in Add category page";
    }elseif($do == 'Insert'){
          echo " welcome You are in Insert category page";
    }else{
           echo "Error there \No page with this name"; }