<?php    
      ob_start();//Output Buffering start
      session_start();

      
          if (isset($_SESSION['Username' ])){
            $pageTitle = 'Dashboard'; 
                     include 'init.php';
                     /*Start Dashboard Page */
                     $numUsers = 5; // Number Of Latest Users
                     $latestUsers = getLatest("*","users", "UserID", $numUsers); //Latest Users Array
                     $numItems = 5; //Number of latest items
                     $latestItems = getLatest("*" , "items", "Item_ID" , "$numItems"); // Latest Items Array

                     ?>
                     <div class="container home-stats text-center">
                        <h1>Dashboard</h1>
                        <div class="row">
                              <div class="col-md-3">
                                    <div class="stat st-members bg-primary">
                                          <i class="fa fa-users"></i>
                                          <div class="info">
                                               Total Members
                                               <span class="d-block fs-1"><a href="members.php"><?php echo countItems('UserID' , 'users')?></a></span>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat st-pending text-light bg-success p-3 rounded-3">
                                          <i class ="fa fa-user-plus"></i>
                                          <div class = "info">
                                               Pending Members
                                               <span class="d-block fs-1"><a href="members.php?do=Manage&page=pending">
                                                     <?php echo checkItem('RegStatus' ,'users' , 0);?>
                                                </a></span>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat st-item text-light bg-secondary p-3 rounded-3">
                                          <i class="fa fa-tag"></i>
                                          <div class="info">
                                               Total Items
                                               <span class="d-block fs-1"><a href="itemss.php"><?php echo countItems('Item_ID' , 'items')?></a></span>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="stat st-comment text-light bg-danger p-3 rounded-3">
                                          <i class ="fa fa-comments"></i>
                                          <div class="info">
                                                Total Comments
                                                <span class="d-block fs-1">0</span>
                                          </div>
                                    </div>
                              </div>

                        </div>
                     </div>
                     <div class="container latest">
                        <div class="row">
                              <div class="col-sm-6">
                                    <div class="panel panel-default">
                                          <div class="panel-heading">
                                                <i class="fa fa-users">Latest <?php echo $numUsers ?> Registerd Users</i>
                                          </div>
                                          <div class="panel-body border ">
                                                <ul class = "list-unstyled latest-users  ">
                                                   <?php  
                                                      foreach( $latestUsers as $user){
                                                            echo '<li>';
                                                               echo $user['Username'];
                                                               echo'<a href="members.php?do=Edit&userid= '.$user['UserID'].'">';
                                                                  echo'<span class= "btn btn-success pull-right">';
                                                                       echo' <i class="fa fa-edit"></i>Edit';
                                                                       if($user['RegStatus'] == 0){
                                                                           echo" <a 
                                                                           href= 'members.php?do=Activate&userid= " .$user['UserID']. " '
                                                                           class='btn btn-info pull-right activate '><i class='fa fa-check'>
                                                                           </i>Activate</a>";
                                                                        }
                                                                  echo'</span>';
                                                                echo '</a>';
                                                            echo '<li/>';
                                                      }
                                                    ?>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-sm-6">
                                    <div class="panel panel-default">
                                          <div class="panel-heading">
                                                <i class="fa fa-tag">Latest Items</i>
                                          </div>
                                          <div class="panel-body border ">
                                          <ul class = "list-unstyled latest-users  ">
                                                   <?php  
                                                      foreach( $latestItems as $item){
                                                            echo '<li>';
                                                               echo $item['Name'];
                                                               echo'<a href="items.php?do=Edit&itemid= '.$item['Item_ID'].'">';
                                                                  echo'<span class= "btn btn-success pull-right">';
                                                                       echo' <i class="fa fa-edit"></i>Edit';
                                                                       if($item['Approve'] == 0){
                                                                           echo" <a 
                                                                           href= 'items.php?do=Approve&itemid= " .$item['Item_ID']. " '
                                                                           class='btn btn-info pull-right activate '>
                                                                           <i class='fa fa-check'></i>Approve</a>";
                                                                        }
                                                                  echo'</span>';
                                                                echo '</a>';
                                                            echo '<li/>';
                                                      }
                                                    ?>
                                                </ul>
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


    ob_end_flush();

?>