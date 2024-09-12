<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
                             
                              UserID   , Username , Password
                         FROM 
                              users 
                         WHERE 
                              Username = ? 
                         AND 
                              Password = ?  ");

          $stmt->execute(array($user , $hashedPass));
          $get = $stmt->fetch();
          $count=$stmt->rowCount();
     
     
          //if count>0 this mean the database contain record about this username
          if ($count > 0){
              $_SESSION['user'] = $user; //register session name
              $_SESSION['uid'] = $get['UserID']; //register session userid

              header('Location : index.php'); //Redirect To Dashboard Page
              exit();
          
             // echo 'welcome' . $username; 

          }
     } else {
          $username = $_POST['username'];
          $password = $_POST['password'];
          $password2 = $_POST['password2'];
          $email    = $_POST['email'];
          $name = $_POST['fullname'];

          $formErrors = array();
          if(isset($username)){
               $filterdUser = filter_var($username, FILTER_SANITIZE_STRING);
               if(strlen($filterdUser) < 4){
                    $formErrors[] = 'Username Must Be Larger Than 4 Character';
               }
          }
          if(isset($password) && isset($password2)){
               if(empty($password)){
                    $formErrors[] = 'Sorry Password Cant Be Empty';

               }
               $pass1 = sha1($password);
               $pass2 = sha1($password2);
               if($pass1 !== $pass2){
                    $formErrors[] = 'sorry Password Is Not Match';
               }
          }
          if(isset($email)){
               $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
               if(filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true){
                    $formErrors[] = 'This Email Not Valid';
               }
          }
          //check if theres no error proceed the user add
          if (empty ($formErrors)){

                //check if user exist in database
               $check= checkItem("Username" , "users", $username);
               if($check == 1){
                    $formErrors[] = ' Sorry This User is exist';
                    
               }else{
                           //Insert user info in database

                                $stmt = $con->prepare("INSERT INTO 
                                                        users(Username, Password, Email ,FullName ,RegStatus, Date)
                                                        VALUES(:zuser, :zpass, :zmail , :zname , 0,now())");
                                $stmt->execute(array(
                                           'zuser' => $username,
                                           'zpass' => sha1($password),
                                           'zmail' => $email,
                                           'zname' => $name
                                 ));

                                 //Echo success messag
                                        $succesMsg = 'Congrats You Are Now Registerd User';
                    }
          }
     }

}

?>
<div class="container login-page">
     <h1 class="text-center">
        <span class=" selected" data-class="login">Login</span> | 
        <span data-class="signup">Signup</span>
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
                class= "form-control" 
                type="text" 
                name="fullname" 
                placeholder="Type full name" />
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
          if(isset($succesMsg)){
               echo '<div class="msg-success">' .$succesMsg. '</div>';
          }
          ?>

     </div>
</div>

<?php
include $tpl .'footer.php';

?>