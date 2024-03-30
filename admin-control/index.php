<?php
session_start();
$noNavbar = '';
$pageTitle = 'Login';
if(isset($_SESSION['Username'])){
      header('Location: dashboard.php');
  }
include 'init.php';

//check if user coming from HTTP POST REQUEST
 if($_SERVER['REQUEST_METHOD'] == 'POST'){

       $username = $_POST['user'];
       $password = $_POST['pass'];
       $hashedPass= sha1($password);
       //echo $username . ' ' . $hashedPass

      
       //Check If The USer Exist In Database
       $stmt = $con->prepare("SELECT      
                               
                                `UserID` ,`Username`, `Password` 
                               FROM 
                                  `shop`.`users` 
                              WHERE 
                                  `Username` = ? 
                              AND 
                                  `Password` = ? 
                              AND 
                                   GroupID = 1
                                   
                              LIMIT 1 ");

       $stmt->execute(array($username , $hashedPass));
       $row = $stmt->fetch();
       $count=$stmt->rowCount();
       
       
       //if count>0 this mean the database contain record about this username
       if ($count > 0){
           $_SESSION['Username'] = $username; //register session name
           $_SESSION['ID'] = $row['UserID']; //register session id 
            header('Location : dashboard.php'); //Redirect To Dashboard Page
            exit();
            
            echo 'welcome' . $username; 

       }

 }

?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="POST">
      <h4 class="text-center">Admin Login</h4>
      <input class="form-control"  type="text" name="user" placeholder="Username" autocomplete="off">
      <input class="form-control"  type="password" name="pass" placeholder="Password" autocomplete="new_password">
      <input class="btn btn-primary btn-block " type="submit" value="Login">



</form>
<i class="fa-brands fa-facebook"></i>

<?php
include $tpl . 'footer.php';
?>


