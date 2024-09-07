<?php
session_start();
$pageTitle = 'Login';
if(isset($_SESSION['user'])){
     header('Location: index.php');
 }
include 'init.php';
//check if user coming from HTTP POST REQUEST
if($_SERVER['REQUEST_METHOD'] == 'POST'){

     if(isset($_POST['login'])){


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
     } else {
          $formErrors = array();
          if(isset($_POST['username'])){
               $filterdUser = filter_var($_POST['username'] , FILTER_SANITIZE_STRING);
               if(strlen($filterdUser) < 4){
                    $formErrors[] = 'Username Must Be Larger Than 4 Character';
               }
          }
          if(isset($_POST['password']) && isset($_POST['password2'])){
               if(empty($_POST['password'])){
                    $formErrors[] = 'Sorry Password Cant Be Empty';

               }
               $pass1 = sha1($_POST['password']);
               $pass2 = sha1($_POST['password2']);
               if($pass1 !== $pass2){
                    $formErrors[] = 'sorry Password Is Not Match';
               }
          }
          if(isset($_POST['email'])){
               $filterdEmail = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
               if(filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true){
                    $formErrors[] = 'This Email Not Valid';
               }
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
                pattern=".{4,8}"
                title= "username must be between 4 chars"
                class= "form-control" 
                type="text" 
                name="username" 
                autocomplete="off" 
                placeholder="Type Your Username" 
                required/>
        </div>  
        <div class="input-container">   
           <input 
                minlength="4"
                class= "form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password" 
                placeholder="Type a Complex Password" 
                required/>
        </div>
        <div class="input-container">
            <input 
                minlength="4"
                class= "form-control" 
                type="password" 
                name="password2" 
                autocomplete="new-password" 
                placeholder="Type a password again" 
                required/>
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
     <div class="the-error text-center">
          <?php
          if(!empty($formErrors)){
               foreach($formErrors as $error){
                    echo $error . '<br>';
               }
          }
          ?>

     </div>
</div>

<?php
include $tpl .'footer.php';

?>