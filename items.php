<?php
ob_start();
session_start();
$pageTitle = 'show items';
include 'init.php';
         //check if Get Request Userid Is Numeric & Get The Integer Value Of It
         $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0 ;

         //echo $userid;

         //Select All Data Depend On Thid ID 
        $stmt = $con->prepare("SELECT * FROM items WHERE  Item_ID = ?  ");
         
        //Execute Query
      $stmt->execute(array($itemid));
        //FetCH THe Data
      $item = $stmt->fetch();
   ?>
<h1 class="text-center">My Profile</h1>

<?php 
include $tpl .'footer.php';
ob_end_flush();
?>