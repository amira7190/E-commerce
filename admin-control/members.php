<?php
/**
 * manage member page
 * you can add |edit | delete members from here
 */

 session_start();

$pageTitle = 'Members';
      

 if (isset($_SESSION['Username'])){
            include 'init.php';

            $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
            if($do == 'Manage'){
                //manage page
            } elseif ($do == 'Edit'){//Edit Page
              // echo 'welcome to edit your id is' . $_GET['userid'];
              ?>
              <h1 class = "text-center  "> Edit Member</h1>

              <div class="container">
                 <div class="form-horizontal">
                    <!-- Start username filed -->
                      <div class="form-group form-group-lg">
                        <label class = "col-sm-2 control-label"> Username</label>
                        <div class="col-sm-10">
                          <input type="text" name="username" class="form-control" autocomplete="off" />
                        </div>
                      </div>
                    <!-- end username filed -->
                    <!-- Start password filed -->
                    <div class="form-group form-group-lg">
                        <label class = "col-sm-2 control-label"> Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control"  autocomplete="new-password"/>
                        </div>
                      </div>
                    <!-- end password filed -->
                    <!-- Start email filed -->
                    <div class="form-group form-group-lg">
                        <label class = "col-sm-2 control-label"> Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" />
                        </div>
                      </div>
                    <!-- end email filed -->
                    <!-- Start fullname filed -->
                    <div class="form-group form-group-lg">
                        <label class = "col-sm-2 control-label"> Full Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="full" class="form-control" />
                        </div>
                      </div>
                    <!-- end fullname filed -->
                    <!-- Start submit filed -->
                    <div class="form-group form-group-lg">
                        <div class=" col-sm-offset-2 col-sm-10">
                          <input type="submit" value="save" class="btn btn-primary btn-lg" />
                        </div>
                      </div>
                    <!-- end submit filed -->
                 </div>

              </div>
            
            <?php          
            

            }






            include $tpl . 'footer.php'; 

     } else {

             header("Location: index.php");

       exit();


  }

  