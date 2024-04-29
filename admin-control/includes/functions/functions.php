<?php
     /*
     ** Home Page v 1.0
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
   **Home Redirection Function v 1.0
   **  [This Function This Function Accept Parameters ]
   **$errorMsg = echo the error message
   **$seconds = seconds before redirecting
   */

   function redirectHome($errorMsg , $seconds = 3){
     echo "<div class = 'alert alert-danger'>$errorMsg</div> ";
     echo "<div class = 'alert alert-info'>You Will Be Redirected To Home Page After $seconds seconds.</div> ";
     header("refresh:$seconds;url=index.php");
     exit();
   }


   /*
   **check items function v 1.0
   **function to check item in database [function accept parameters]
   **$Select = the item to select [exemple: user , item , category]
   **$from = the table to select from [exemple : users , items , categories]
   **$value =the value of select [exemple : osama , box , electronics]
   */

   function checkItem($select , $from , $value){
     global $con;
     $statement = $con->prepare("SELECT $select FROM $from WHERE $select =?");
     $statement->execute(array($value));
     $count = $statement -> rowcount();
     return $count;
   }