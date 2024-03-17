<?php    

      session_start();

      

          if (isset($_SESSION['Username'])){
      
                     include 'init.php';

              } else {
    
                      header("Location: index.php");

                exit();
     

           }




?>