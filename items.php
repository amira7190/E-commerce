<?php
ob_start();
session_start();
$pageTitle = 'show items';
include 'init.php';
         //check if Get Request Userid Is Numeric & Get The Integer Value Of It
         $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0 ;

         //echo $userid;

        
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
                                  Item_ID = ? ");

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
    <div class="col-md-9 item-info">
      <h2><?php echo $item['Name'] ?></h2>
      <p><?php echo $item['Description'] ?></p>
      <ul class="list-unstyled">
            <li>
              <i class=" fa fa-calendar fa-fw"></i>
            <span><?php echo $item['Add_Date'] ?></span>
          </li>
            <li>
            <i class=" fa fa-money fa-fw"></i>
            <span> Price</span>  : $<?php echo $item['Price'] ?>
          </li>
            <li>
            <i class=" fa fa-building fa-fw"></i>
              <span> Made In</span> : <?php echo $item['Country_Made'] ?>
            </li>
            <li>
            <i class=" fa fa-tags fa-fw"></i>
              <span> category</span> :<a href="categories.php?pageid= <?php echo $item['Cat_ID'] ?> ">  <?php echo $item['category_name'] ?></a>
            </li>
            <li>
            <i class=" fa fa-user fa-fw"></i>
              <span> Added by </span>:<a href="#"> <?php echo $item['Username'] ?></a>
            </li> 
      </ul>







    </div>
  </div>
  <hr class="custom-hr">
  <div class="row">
    <div class="col-md-3">
      User Image
    </div>
    <div class="col-md-9">
      User Comment
    </div>
  </div>
</div>

<?php }else{
    echo ' theres no such id';
}
include $tpl .'footer.php';
ob_end_flush();
?>