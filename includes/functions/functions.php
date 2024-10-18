<?php
/*
  **Get ALL Function v 2.0
  **Function To  Get All Records From Any Database Table 
  **
  **
  **
  */
  function getAllFrom($field , $table , $where = NULL , $and = NULL ,$orderfield ,$ordering ="DESC"){
     global $con;
     $getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield  $ordering");
     $getAll->execute();
     $all = $getAll->fetchAll();
     return $all;
  }


/*
  **Get L Categories Function v 1.0
  **Function To  Get categories From Database 
  **
  **
  **
  */
  function getCat(){
     global $con;
     $getCat = $con->prepare("SELECT * FROM categories ORDER BY ID ASC ");
     $getCat->execute();
     $cats = $getCat->fetchAll();
     return $cats;
  }

  /*
  **check if user is not activated 
  **function to check the regstatus of the user
  */
function checkUserStatus($user){
   global $con;
     $stmtx= $con->prepare("SELECT      
                             
                              Username , RegStatus
                         FROM 
                              users 
                         WHERE 
                              Username = ? 
                         AND 
                              RegStatus = 0  ");

     $stmtx->execute(array($user));
     $status=$stmtx->rowCount();
     return $status;
     
}
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
   **Home Redirection Function v 2.0
   **  [This Function This Function Accept Parameters ]
   **theMsg = echo the message [Error | success | warning]
   ** $url = the link you want to redirect  to
   **$seconds = seconds before redirecting
   */

   function redirectHome($theMsg ,$url = null , $seconds = 3){
     if ($url === null){
          $url = 'index.php';
     }else{
          $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ? $_SERVER['HTTP_REFERER'] : 'index.php';
          $link = 'previous page';
     }
     echo $theMsg;
     echo "<div class = 'alert alert-info'>You Will Be Redirected To $link After $seconds seconds.</div> ";
     header("refresh:$seconds;url=$url");
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
   /*
   **Count Number Of Items Function v 1.0
   **Function To Count Number Of Items Rows
   ** $item= the item to count
   **$table = the table to choose from
   */
  function countItems($item , $table){
     global $con;
     $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
     $stmt2->execute();
     return $stmt2->fetchColumn();

  }


  /*
  **Get Latest Records Function v 1.0
  **Function To  Get Latest Item From Database [users , item , comment] 
  **
  **
  **
  */
  function getLatest($select , $table , $order,$limit =5){
     global $con;
     $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC  LIMIT $limit");
     $getStmt->execute();
     $rows = $getStmt->fetchAll();
     return $rows;
  }
