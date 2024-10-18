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

  <?php if(isset($_SESSION['user'])){ ?>

  <!--Start Add Comment-->
  <div class="row">
    <div class="col-md-offset-3">
      <div class="add-comment">

        <h3>Add Your Comment</h3>
        <form action=" <?php echo $_SERVER['PHP_SELF'] .'?itemid=' . $item['Item_ID'] ?>" method="POST">
          <textarea name="comment required"></textarea>
          <input class="btn btn-primary" type="submit" value="Add Comment">
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $comment   = filter_var($_POST['comment'] , FILTER_SANITIZE_STRING);
            $userid    = $_SESSION['uid'];
            $itemid    = $item['Item_ID'];
            if(! empty($comment)){
              $stmt = $con->prepare("INSERT INTO
                    comments(comment, status, comment_date, item_id, user_id)
                    VALUES(:zcomment, 0 , NOW(), :zitemid, :zuserid)
              ");
              $stmt->execute(array(
                'zcomment' => $comment,
                'zitemid'  => $itemid,
                'zuserid'  => $userid
              ));
              if($stmt->rowCount() > 0){
                echo '<div class="alert alert-success">Comment Added</div>';
            }else{
              echo'nothing';
            }
            
            }
        }
        ?>
      </div>
    </div>
  </div>
  <!-- End Add Comment-->
   <?php }else{
    echo '<a href ="login.php">Login</a> Or <a href="login.php">Register</a> To Add Comment';

   } ?>
  <hr class="custom-hr">
  <?php
                  //Select All Users Execept Admin//
                  $stmt = $con->prepare("SELECT 
                  comments.*, users.Username AS Member 
              FROM 
                  comments
              INNER JOIN
                  users
              ON
                  users.UserID = comments.user_id
              WHERE 
                  item_id = ?
              AND
                  status = 1
              ORDER BY
                  c_id DESC
              ");
             //Execute The Statement
            $stmt ->execute(array($item['Item_ID']));
            //Assign To Variable
            $comments =$stmt->fetchAll();
            
      ?>
  
    <?php
        foreach($comments as $comment){ ?>
        <div class="comment-box">
                
                <div class="row">
                  <div class = "col-sm-2 text-center d-block m-auto">
                  <img class="img-fluid rounded-circle img-responsive" src="avatar.png"  alt=""  />
                    
                  <?php echo $comment['Member'] ?> </div>
                  
                  <div class = "col-sm-10">
                    <p class="lead"><?php echo $comment['comment'] ?> </p>
                  </div>

                </div>
        </div>
<hr class="custom-hr">

   <?php }
    ?>
</div>

<?php }else{
    echo ' theres no such id';
}
include $tpl .'footer.php';
ob_end_flush();
?>