<?php
session_start();
$pageTitle = 'Profile';
include 'init.php';
if(isset($_SESSION['user'])){
   $getUser = $con->prepare(" SELECT * 
                              FROM 
                                   users
                              WHERE
                                   Username =?
                                ");
    $getUser->execute(array($sessionUser));
    $info=$getUser->fetch();
    $userid= $info['UserID'];
?>
<h1 class="text-center">My Profile</h1>
<div class="information block">
    <div class="container">
        <div class="card">
            <div class="card-header">My Information</div>
            <div class="card-body">
                <ul class = "list-unstyled">
                    <li>
                        <i class = "fa fa-unlock-alt fa-fw "></i>
                        <span>Login Name </span> : <?php echo $info['Username'] ?> 
                    </li>
                    <li>
                        <i class="fa fa-envelope-o fa-fw"></i>
                        <span> Email </span> : <?php echo $info['Email'] ?> 
                    </li>
                    <li>
                        <i class = "fa fa-user fa-fw "></i>
                        <span> Full Name </span> : <?php echo $info['FullName'] ?> 
                    </li>
                    <li>
                        <i class = "fa fa-calendar fa-fw "></i>
                        <span> Register Date </span> : <?php echo $info['Date'] ?> 
                    </li>
                    <li>
                        <i class = "fa fa-tags fa-fw "></i>
                        <span> Favourite Category </span> : 
                    </li>
                </ul>
                <a href="#" class="btn btn-default">Edit Information</a>
            </div>
        </div>
    </div>
</div>
<div class="my-ads block">
    <div class="container">
        <div class="card">
            <div class="card-header">My Items</div>
            <div class="card-body">
                <?php
                        $myItems= getAllForm( "*", "items" , "where Member_ID = $userid" , " ", "Item_ID" );
                        if(! empty($myItems)){
                            echo '<div class="row">';
                            foreach($myItems as $item){
                                echo'<div class="col-sm-6 col-md-3">'; 
                                    echo'<div class="card item-box">';
                                        if($item['Approve'] == 0){
                                             echo  '<span class="approve-status">Waiting Approval</span>'   ;
                                            };
                                        echo'<span class="price-tag">' .$item['Price'] . '</span>';
                                        echo'<img class="img-fluid" src="avatar.png"  alt=""  />';
                                        echo '<div class="caption">';
                                            echo'<h3><a href="items.php?itemid='.$item['Item_ID'] .'">' .$item['Name']. '</a></h3>';
                                            echo'<p>' .$item['Description']. '</p>';
                                            echo'<div class="date">' .$item['Add_Date']. '</div>';

                                        echo'</div>';
                                    echo'</div>';
                                echo'</div>';
                            }
                            echo'</div>';
                        }else {
                            echo 'sorry theres no add to show , creat <a href="newad.php">New Ad</a>';
                        }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="my-comments block">
    <div class="container">
        <div class="card">
            <div class="card-header">Latest Comments</div>
            <div class="card-body">
            <?php
               $myComments = getAllFrom( "comment" , "comments" , " where user_id = $userid " , " " , "c_id" );
               
               if(! empty($myComments)){
                    foreach($myComments as $comment ){
                        echo '<p>'. $comment['comment'] . '</p>';
                    }

                } else {
                 echo 'There\'s no comments to show';
                }
            
            ?>
            </div>
        </div>
    </div>
</div>
<?php } else {
    header('Location: login.php');
    exit();
}
include $tpl .'footer.php';

?>