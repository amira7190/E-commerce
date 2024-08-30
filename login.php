<?php
include 'init.php';
?>
<div class="container login-page">
     <h1 class="text-center">
        <span class=" selected" data-class="login">Login</span> | 
        <span data-class="signup">Signup<span>
     </h1>
     <form class="login">
        <div class="input-container">
           <input 
                class= "form-control" 
                type="text" 
                name="username" 
                autocomplete="off" 
                placeholder="Type Your Username"
                required />
        </div>
           <input 
                class= "form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password" 
                placeholder="Type Your Password" />
           <input 
                class= "btn btn-primary btn-block" 
                type="submit" 
                value="Login"/>
      </form>
      <form class="signup">
           <input 
                class= "form-control" 
                type="text" 
                name="username" 
                autocomplete="off" 
                placeholder="Type Your Username" />
           <input 
                class= "form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password" 
                placeholder="Type a Complex Password" />
            <input 
                class= "form-control" 
                type="password" 
                name="password2" 
                autocomplete="new-password" 
                placeholder="Type a password again" />
            <input 
                class= "form-control" 
                type="email" 
                name="email" 
                placeholder="Type a valid email" />
           <input 
                class= "btn btn-success btn-block" 
                type="submit" 
                value="Signup"/>
      </form>
</div>

<?php
include $tpl .'footer.php';

?>