<?php
session_start();
$pageTitle = 'Login';
if(isset($_SESSION['user'])){
     header('Location: index.php');
 }
include 'init.php';
//check if user coming from HTTP POST REQUEST
if($_SERVER['REQUEST_METHOD'] == 'POST'){

     if(isset($_post['login'])){


          $user = $_POST['username'];
          $pass = $_POST['password'];
          $hashedPass= sha1($pass);
          // echo  $password ;

    
            //Check If The USer Exist In Database
          $stmt = $con->prepare("SELECT      
                             
                              Username , Password
                         FROM 
                              users 
                         WHERE 
                              Username = ? 
                         AND 
                              Password = ?  ");

          $stmt->execute(array($user , $hashedPass));
          $count=$stmt->rowCount();
     
     
          //if count>0 this mean the database contain record about this username
          if ($count > 0){
              $_SESSION['user'] = $user; //register session name
              header('Location : index.php'); //Redirect To Dashboard Page
              exit();
          
             // echo 'welcome' . $username; 

          }
     }   

}

?>
<div class="container login-page">
     <h1 class="text-center">
        <span class=" selected" data-class="login">Login</span> | 
        <span data-class="signup">Signup<span>
     </h1>
     <!---start login form --->
     <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="POST">
        <div class="input-container">
           <input 
                class= "form-control" 
                type="text" 
                name="username" 
                autocomplete="off" 
                placeholder="Type Your Username"
                required />
        </div>
        <div class="input-container">
           <input 
                class= "form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password" 
                placeholder="Type Your Password" />
           <input 
                class= "btn btn-primary btn-block" 
                name="login"
                type="submit" 
                value="Login"/>
        </div>
     </form>
     <!---end login form--->
     <!---start signup form--->
     <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="POST">
          <div class="input-container">
           <input 
                class= "form-control" 
                type="text" 
                name="username" 
                autocomplete="off" 
                placeholder="Type Your Username" />
        </div>  
        <div class="input-container">   
           <input 
                class= "form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password" 
                placeholder="Type a Complex Password" />
        </div>
        <div class="input-container">
            <input 
                class= "form-control" 
                type="password" 
                name="password2" 
                autocomplete="new-password" 
                placeholder="Type a password again" />
        </div>
        <div class="input-container">
            <input 
                class= "form-control" 
                type="email" 
                name="email" 
                placeholder="Type a valid email" />
        </div>
        <div class="input-container">
           <input 
                class= "btn btn-success btn-block" 
                name="signup"
                type="submit" 
                value="Signup"/>
        </div>
     </form>
     <!---end signup form--->
</div>

<?php
include $tpl .'footer.php';

?>