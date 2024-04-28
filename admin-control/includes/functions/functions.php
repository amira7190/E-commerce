<?php
     /*
** Title of the page if exist
** default title if not exist
*/

   function getTitle() {

    global $pageTitle ;

    if(isset($pageTitle)){

         echo $pageTitle;

    } else {

         echo 'Default';
    }
   }


   /*
   ** Home Redirection Function [This Function This Function Accept Parameters ]
   **$errorMsg = echo the error message
   **$seconds = seconds before redirecting
   */

   function redirectHome($errorMsg , $seconds = 3){
     echo "<div class = 'alert alert-danger'>$errorMsg</div> ";
     echo "<div class = 'alert alert-info'>You Will Be Redirected To Home Page After $seconds seconds.</div> ";
     header("refresh:$seconds;url=index.php");
     exit();


   }