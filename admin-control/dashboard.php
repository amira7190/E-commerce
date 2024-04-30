<?php    

      session_start();

      

          if (isset($_SESSION['Username'])){
            $pageTitle = 'Dashboard'; 
                     include 'init.php';
                     /*Start Dashboard Page */
                     ?>
                     <div class="container home-stats text-center">
                        <h1>Dashboard</h1>
                        <div class="row">
                              <div class="col-md-3">
                                    <div class="stat border ">
                                         Total Members
                                         <span class="d-block fs-1"><?php echo countItems('UserID' , 'users')?></span>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat border">
                                          Pending Members
                                          <span class="d-block fs-1">25</span>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat border">
                                          Total Items
                                          <span class="d-block fs-1">1500</span>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat border">
                                          Total Comments
                                          <span class="d-block fs-1">3500</span>
                                    </div>
                              </div>

                        </div>
                     </div>
                     <div class="container latest">
                        <div class="row">
                              <div class="col-sm-6">
                                    <div class="panel panel-default">
                                          <div class="panel-heading">
                                                <i class="fa fa-users">Latest Registerd Users</i>
                                          </div>
                                          <div class="panel-body border ">
                                                Test
                                          </div>
                                    </div>
                              </div>
                              <div class="col-sm-6">
                                    <div class="panel panel-default">
                                          <div class="panel-heading">
                                                <i class="fa fa-tag">Latest Items</i>
                                          </div>
                                          <div class="panel-body border ">
                                                Test
                                          </div>
                                    </div>
                              </div>
                        </div>
                     </div>











                    <?php
                     /*End Dashboard Page*/
                     
                     include $tpl . 'footer.php'; 

              } else {
    
                      header("Location: index.php");

                exit();
     

           }




?>