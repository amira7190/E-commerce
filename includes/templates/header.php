<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin-control</title>
    <link rel="stylesheet" href="<?php  echo $css ; ?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php  echo $css ; ?>all.min.css"/>
    <link rel="stylesheet" href="<?php  echo $css ; ?>fontawesome.min.css"/>
    <link rel="stylesheet" href="<?php  echo $css ; ?>front.css"/>
</head>
<body>
    <div class="upper-bar">
        <div class="container">
            <?php
              if(isset($_SESSION['user'])){?>
                 <!-- Example split danger button -->
                <div class="btn-group my-info">
                      <span class="btn dropdown-toggle" data-toggle="dropdown">
                        <?php echo $sessionUser ?>
                        <span class="caret"></span>

                      </span>
                     <ul class="dropdown-menu">
                        <li><a href="profile.php">My Profile</a></li>
                        <li><a href="newad.php">New Item</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                     </ul>
                </div>

                

                <?php
              }else{

              
           
            ?>
                  <a href="login.php">
                    <span class="pull-right">Login/Signup</span>
                  </a>
              <?php } ?>
        </div>
    </div>
<nav class="navbar navbar-expand-lg bg-dark ">
  <div class="container">
    <a class="navbar-brand" href="index.php">Homepage</a>
    <button class="navbar-toggler border-secondry" type="button" data-bs-toggle="collapse" data-bs-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="navbar-nav navbar-right me-auto mb-2 mb-lg-0">
        <?php 
           foreach(getCat() as $cat){
                echo '<li>
                        <a href="categories.php?pageid='. $cat['ID'].'">
                            '.$cat['Name'] .'
                        </a>
                      </li>';
           } 
        ?>
      </ul>
    </div>
  </div>
</nav>