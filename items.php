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
         // Select All Data Depend On This ID
	$stmt = $con->prepare("SELECT 
                                  items.*, 
                                  categories.Name AS category_name, 
                                  users.Username 
                              FROM 
                                  items
                              INNER JOIN 
                                  categories 
                              ON 
                                  categories.ID = items.Cat_ID 
                              INNER JOIN 
                                  users 
                              ON 
                                  users.UserID = items.Member_ID 
                              WHERE 
                                  Item_ID = ?
                              AND 
                                 Approve = 1");

        //Execute Query
      $stmt->execute(array($itemid));
      $count = $stmt->rowcount();
      if($count > 0){

      
        //FetCH THe Data
      $item = $stmt->fetch();
   ?>
<h1 class="text-center">My Profile</h1>
<div class="container">
  <div class="row">
    <div class="col-md-3">
    <img class="img-fluid img-card center-block" src="avatar.png"  alt=""  >
    </div>
    <div class="col-md-9">
      <h2><?php echo $item['Name'] ?></h2>
      <p><?php echo $item['Description'] ?></p>
      <span><?php echo $item['Add_Date'] ?></span>
      <div> Price: $<?php echo $item['Price'] ?></div>
      <div> Made In : <?php echo $item['Country_Made'] ?></div>
      <div> category : <?php echo $item['Category_name'] ?></div>
      <div> Added by : <?php echo $item['Username'] ?></div>







    </div>
  </div>
</div>

<?php }else{
    echo ' theres no such id';
}
include $tpl .'footer.php';
ob_end_flush();
?>