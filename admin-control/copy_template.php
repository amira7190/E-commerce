         
<?php
ob_start();

session_start();

$pageTitle = 'Categories';

  if(isset($_SESSION['Username'])){
      
          include 'init.php';

          $do = isset($_GET['do'])  ?  $_GET['do'] : 'Manage';

          if($do == 'Manage'){

          }
          elseif($do == 'add'){ 

         }elseif($do == 'Insert'){


         }elseif($do == 'Edit'){

         }elseif($do == 'Update'){
         

         }elseif($do == 'Delete'){
          

         }
          include $tbl . 'footer.php';
    
    }else{

        header("Location : index.php");
        exit();
    }

ob_end_flush();
?>