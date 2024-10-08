<?php 
/**
 * manage member page
 * you can add |edit | delete members from here
 */

 ob_start(); //Output Buffering Start

 session_start();

$pageTitle = 'Members';
      

 if (isset($_SESSION['Username'])){
            include 'init.php';

            $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
            
            if($do == 'Manage'){ //manage page 
               $query = '';
               if(isset($_GET['page']) && $_GET['page'] == 'pending'){
                    $query = 'AND RegStatus = 0';
               }

               //Select All Users Execept Admin//
               $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query OREDER BY UserID DESC");
               //Execute The Statement
               $stmt ->execute();
               //Assign To Variable
               $rows =$stmt->fetchAll();
               if(! ($rows)){
            
            
            
            ?> 
                   
                     <h1 class = "text-center  "> Manage members</h1>
                     <div class="container">
                                <div class="table-responsive">
                                      <table class=" main-table text-center  table table-bordered">
                                        <tr class="bg-secondary text-light">
                                             <td>#ID</td>
                                             <td>Username</td>
                                             <td>Email</td>
                                             <td>Full Name</td>
                                             <td>Registed Date</td>
                                             <td>Control</td>
                                        </tr>
                                        <?php
                                            foreach($rows as $row){
                                             echo "<tr>";
                                                  echo "<td>" . $row['UserID'] . "</td>";
                                                  echo "<td>" . $row['Username'] . "</td>";
                                                  echo "<td>" . $row['Email'] . "</td>";
                                                  echo "<td>" . $row['FullName'] . "</td>";
                                                  echo "<td>" . $row['Date'] . "</td>";
                                                  echo "<td>
                                                       <a href='members.php?do=Edit&userid= " .$row['UserID'] ." 'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
                                                       <a href= 'members.php?do=Delete&userid= " .$row['UserID']. " 'class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
                                        
                                                       if($row['RegStatus'] == 0){
                                                             echo" <a 
                                                             href= 'members.php?do=Activate&userid= " .$row['UserID']. " '
                                                             class='btn btn-info activate '>
                                                             <i class='fa fa-check'></i>Activate</a>";
                                                       }
                                                   echo "</td>";
                                                  
                                             echo "</tr>";

                                            }
                                        ?>
                                        <tr>
                                      </table>

                              </div>
                              <a href="members.php?do=Add" class ="btn btn-primary"> <i class ="fa fa-plus"></i>Add New Member</a>
                     </div>
               
                <?php }else{
                    echo '<div class= "container">';
                         echo '<div class= "nice-message">Theres No Record To Show</div>';
                    echo '</div>';
                } ?> 
                          
          <?php  } elseif ($do == 'Add'){ ?>   <!--Add Members Page-->
                        
              <h1 class = "text-center  "> Add New Member</h1>
              <div class="container">
                    <form class="form-horizontal" action ="?do=Insert" method ="POST">
                                     <!-- Start username filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Username</label>
                                     <div class="col-sm-10">
                                         <input type="text" name="username" class="form-control" autocomplete="off"  required = "required"/>
                                      </div>
                                 </div>
                                      <!-- end username filed -->


                                     <!-- Start password filed -->
                                 <div class="form-group form-group-lg">
                                     <label class = "col-sm-2 control-label"> Password</label>
                                     <div class="col-sm-10">
                                          <input type="password" name="password" class="form-control"  autocomplete="new-password" required = "required" placeholder = ""/>
                                     </div>
                                  </div>
                                        <!-- end password filed -->


                                        <!-- Start email filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label"> Email</label>
                                      <div class="col-sm-10">
                                         <input type="email" name="email"  class="form-control"  required = "required" placeholder = ""/>
                                      </div>
                                  </div>
                                       <!-- end email filed -->


                                        <!-- Start fullname filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label"> Full Name</label>
                                      <div class="col-sm-10">
                                             <input type="text" name="full"  class="form-control"   placeholder =""/>
                                      </div>
                                  </div>
                                        <!-- end fullname filed -->


                                        <!-- Start submit filed -->
                                   <div class="form-group form-group-lg">
                                        <div class=" col-sm-offset-2 col-sm-10">
                                               <input type="submit" value="Add Member" class="btn btn-primary btn-lg" />
                                         </div>
                                   </div>
                                        <!-- end submit filed -->
                 </div>

              </form>

        </div> 
                        

      <?php 
            }   elseif ($do == 'Insert') {
               //Insert Member Page
        
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){

                              echo "<h1 class = 'text-center'> Insert Member</h1>";
                              echo "<div class = 'container'> ";
                                  //Get variable from the form
                                  $id    = $_POST['userid'];
                                  $user  = $_POST['username'];
                                  $pass  = $_POST['password'];
                                  $email = $_POST['email'];
                                  $name  = $_POST['full'];
                                  $hashPass = sha1($_POST['password']);

                   
                                  //Validate The Form
                                  $formErrors = array();

                                        if(strlen($user) < 4){
                                               $formErrors[] = ' username cant be less than <strong>4 char</strong>';
                                        }

                                      if(empty($user)){
                                             $formErrors[] = 'User name Cant Be <strong>Empty</strong>';
                                        }
                                        if(empty($pass)){
                                             $formErrors[] = 'User pass Cant Be <strong>Empty</strong>';
                                        }
                                      if(empty($name)){
                                             $formErrors[] = 'Full name Cant Be <strong>Empty</strong>';
                                        }
                                     if(empty($email)){
                                              $formErrors[] = 'Email Cant Be <strong>Empty</strong>';
                                        }
                                    foreach($formErrors as $error){
                                             echo $error ;
                                        }


                                        //check if theres no error proceed the update operation 
                                     if (empty ($formErrors)){

                                        $check= checkItem("username" , "users", $user);
                                        if($check == 1){

                                             $theMsg ="<div class = 'alert alert-danger'>Sorry This User Is Exist</div>";
                                             redirectHome($theMsg , 'back');
                                        }else{
                                                    //Insert user info in database

                                                         $stmt = $con->prepare("INSERT INTO 
                                                                                 users(Username, Password, Email, Fullname ,RegStatus, Date)
                                                                                 VALUES(:zuser, :zpass, :zmail, :zname , 1,now())");
                                                         $stmt->execute(array(
                                                                    'zuser' => $user,
                                                                    'zpass' => $hashPass,
                                                                    'zmail' => $email,
                                                                    'zname' => $name
             

                                                          ));
                 
                                                          //Echo success messag
                                                                 $theMsg = "<div class = 'alert alert-success'>". $stmt->rowCount() . 'Inserted Updated </div>';
                                                                 redirectHome($theMsg , 'back');
                                             }
                                        }

                              }else{
                                   echo '<div class ="container">';
                                        $theMsg = '<div class = "alert alert-danger">Sorry you cant Browse this page directly</div>';
                                        redirectHome($theMsg );
                                   echo '</div>';
                              } 
                               echo "</div>";           

     } elseif ($do == 'Edit'){//Edit Page
              // echo 'welcome to edit your id is' . $_GET['userid'];
                       
                         //check if Get Request Userid Is Numeric & Get The Integer Value Of It
                       $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;

                           //echo $userid;

                           //Select All Data Depend On Thid ID 
                          $stmt = $con->prepare("SELECT * FROM `users` WHERE  `UserID` = ?  LIMIT 1 ");
                           
                          //Execute Query
                        $stmt->execute(array($userid));
                          //FetCH THe Data
                        $row = $stmt->fetch();
                        //The Row Count
                       $count=$stmt->rowCount();
                        //If There Such Id Show The Form
                       if($count > 0){ ?>
                    <h1 class = "text-center  "> Edit Member</h1>
                    <div class="container">
                          <form class="form-horizontal" action ="?do=update" method ="POST">
                                      <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
                                           <!-- Start username filed -->
                                      <div class="form-group form-group-lg">
                                          <label class = "col-sm-2 control-label"> Username</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="username" value = " <?php echo $row['Username']  ?> " class="form-control" autocomplete="off"  required = "required"/>
                                            </div>
                                       </div>
                                            <!-- end username filed -->


                                           <!-- Start password filed -->
                                       <div class="form-group form-group-lg">
                                           <label class = "col-sm-2 control-label"> Password</label>
                                           <div class="col-sm-10">
                                                <input type="hidden" name="oldpassword" value= " <?php echo $row['Password']  ?> "/>
                                                <input type="password" name="newpassword" class="form-control"  autocomplete="new-password"/>
                                           </div>
                                        </div>
                                              <!-- end password filed -->


                                              <!-- Start email filed -->
                                        <div class="form-group form-group-lg">
                                            <label class = "col-sm-2 control-label"> Email</label>
                                            <div class="col-sm-10">
                                               <input type="email" name="email" value = " <?php echo $row['Email']  ?> " class="form-control"  required = "required"/>
                                            </div>
                                        </div>
                                             <!-- end email filed -->


                                              <!-- Start fullname filed -->
                                        <div class="form-group form-group-lg">
                                            <label class = "col-sm-2 control-label"> Full Name</label>
                                            <div class="col-sm-10">
                                                   <input type="text" name="full" value = " <?php echo $row['FullName']  ?> " class="form-control"  required = "required"/>
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

                    </form>

              </div>
            
            <?php  
            }
                                        //If There is No Such ID Show Error Message 
                         else {
                              echo "<div class = 'container'>";
                                   $theMsg = '<div class = "alert alert-danger">Theres Is No Such ID </div>';
                                   redirectHome($theMsg , '');
                              echo "</div>";
                              }       
            

      } elseif ( $do == 'update'){ //update page

          echo "<h1 class = 'text-center'> update Member</h1>";
          echo "<div class = 'container'> ";
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
               //Get variable from the form
              $id    = $_POST['userid'];
              $user  = $_POST['username'];
              $email = $_POST['email'];
              $name  = $_POST['full'];

              //password trick
              //condition ? true : false ;
              $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] :  sha1($_POST['newpassword']) ;
              
              //Validate The Form
              $formErrors = array();

              if(strlen($user) < 4){
                $formErrors[] = '<div class = "alert alert-danger"> username cant be less than <strong>4 char</strong></div>';
              }

              if(empty($user)){
                $formErrors[] = '<div class = "alert alert-danger"> User name Cant Be <strong>Empty</strong></div>';
              }
              if(empty($name)){
                $formErrors[] = '<div class = "alert alert-danger"> Full name Cant Be <strong>Empty</strong></div>';
              }
              if(empty($email)){
                $formErrors[] = '<div class = "alert alert-danger"> Email Cant Be <strong>Empty</strong></div>';
              }
              foreach($formErrors as $error){
                echo $error ;
              }


              //check if theres no error proceed the update operation 
              if (empty ($formErrors)){
                  
                    //UPdate  the database with this info//

                     $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ?  WHERE UserID = ? ");
                     $stmt->execute(array($user , $email , $name ,  $pass , $id));

                     //Echo success message
                      $theMsg = "<div class = 'alert alert-success'>" . $stmt->rowCount() . 'Record Updated </div>';
                      redirectHome ($theMsg , 'back');

              }

           }else{
                    $theMsg= '<div class = "alert alert-danger">you cant Browse this page directly</div>';
                    redirectHome($theMsg);
                } 
            echo "</div>";          




          }elseif ($do == 'Delete'){
               // Delete member page 
               echo "<h1 class = 'text-center'> Delete Member</h1>";
               echo "<div class = 'container'> ";
                       //check if Get Request Userid Is Numeric & Get The Integer Value Of It
                       $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;

                           //echo $userid;
                       $check = checkItem('userid' , 'users' , $userid);

                              //Select All Data Depend On Thid ID 
                              //  $stmt = $con->prepare("SELECT * FROM `users` WHERE  `UserID` = ?  LIMIT 1 ");
                           
                             //Execute Query
                             // $stmt->execute(array($userid));
                             //The Row Count
                             // $count=$stmt->rowCount();
                        //If There Such Id Show The Form
                       if($check > 0){ 

                         $stmt = $con-> prepare("DELETE FROM `users` WHERE `UserID` = :zuser ");
                         $stmt->bindparam(":zuser" , $userid);
                         $stmt->execute();


                         $theMsg = "<div class = 'alert alert-success container'>" . $stmt->rowCount() . 'Record Deleted </div>';
                         redirectHome ($theMsg);




                       }else{
                         echo '<div class = "container">';
                         $theMsg ='<div class = "alert alert-danger">This Id isnot Exist</div>';
                         redirectHome($theMsg , 'back');
                         echo '</div>';
                       }
                       echo '</div>';

          } elseif ($do == 'Activate'){
               echo "<h1 class = 'text-center'> Activate Member</h1>";
               echo "<div class = 'container'> ";
                       //check if Get Request Userid Is Numeric & Get The Integer Value Of It
                       $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;

                           //echo $userid;
                       $check = checkItem('userid' , 'users' , $userid);

                              //if check > 0
                       if($check > 0){ 

                         $stmt = $con-> prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?  ");
                         $stmt->execute(array($userid));


                         $theMsg = "<div class = 'alert alert-success container'>" . $stmt->rowCount() . 'Record Activate </div>';
                         redirectHome ($theMsg);




                       }else{
                         echo '<div class = "container">';
                         $theMsg ='<div class = "alert alert-danger">This Id isnot Exist</div>';
                         redirectHome($theMsg);
                         echo '</div>';
                       }
                       echo '</div>';



          }


          include $tpl . 'footer.php'; 

     }else {

          header("Location: index.php");

    exit();


}
ob_end_flush();



            
  