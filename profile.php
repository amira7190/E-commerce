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
?>
<h1 class="text-center">My Profile</h1>
<div class="information block">
    <div class="container">
        <div class="card">
            <div class="card-header">My Information</div>
            <div class="card-body">
                 Name: <?php echo $info['Username'] ?> </br>
                 Email: <?php echo $info['Email'] ?> </br>
                 Full Name: <?php echo $info['FullName'] ?> </br>
                 Register Date: <?php echo $info['Date'] ?> </br>
                 Favourite Category :
            </div>
        </div>
    </div>
</div>
<div class="my-ads block">
    <div class="container">
        <div class="card">
            <div class="card-header">My Ads</div>
            <div class="card-body">
                 test ads
            </div>
        </div>
    </div>
</div>
<div class="my-comments block">
    <div class="container">
        <div class="card">
            <div class="card-header">Latest Comments</div>
            <div class="card-body">
                test comments
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