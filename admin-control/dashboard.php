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
                                    <div class="stat st-member  text-light bg-primary p-3 rounded-3">
                                         Total Members
                                         <span class="d-block fs-1"><a href="members.php"><?php echo countItems('UserID' , 'users')?></a></span>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat st-pending text-light bg-success p-3 rounded-3">
                                          Pending Members
                                          <span class="d-block fs-1">25</span>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat st-item text-light bg-secondary p-3 rounded-3">
                                          Total Items
                                          <span class="d-block fs-1">1500</span>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat st-comment text-light bg-danger p-3 rounded-3">
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