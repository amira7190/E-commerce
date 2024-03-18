<?php    

      session_start();

      

          if (isset($_SESSION['Username'])){
      
                     include 'init.php';
                     echo "welcome";
                     include $tpl . 'footer.php';

              } else {
    
                      header("Location: index.php");

                exit();
     

           }




?>