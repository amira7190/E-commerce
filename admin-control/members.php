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
            if($do == 'Manage'){ //manage page
                 
                          echo "welcome to manage member ";
                          echo "</br>";
                          echo' <a href = "members.php?do=Add"> add new member</a>';
            } elseif ($do == 'Add'){ ?>   <!--Add Members Page-->
                        
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
                                             <input type="text" name="full"  class="form-control"  required = "required" placeholder =""/>
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
                        

      <?php      } elseif ($do == 'Edit'){//Edit Page
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
                       if($stmt->rowCount() > 0){ ?>
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
                                   echo "Theres Is No Such ID";
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
                                echo "<div class = 'alert alert-success'>" . $stmt->rowCount() . 'Record Updated </div>';

                        }

                     }else{
                              echo 'you cant Browse this page directly';
                          } 
                      echo "</div>";           




          }






            include $tpl . 'footer.php'; 

        }else {

             header("Location: index.php");

       exit();


  }

  