         
<?php
ob_start();

session_start();

$pageTitle = 'Categories';

  if(isset($_SESSION['Username'])){
      
          include 'init.php';

          $do = isset($_GET['do'])  ?  $_GET['do'] : 'Manage';

          if($do == 'Manage'){

          }
          elseif($do == 'add'){ 

         }elseif($do == 'Insert'){


         }elseif($do == 'Edit'){

         }elseif($do == 'Update'){
         

         }elseif($do == 'Delete'){
          

         }
          include $tbl . 'footer.php';
    
    }else{

        header("Location : index.php");
        exit();
    }

ob_end_flush();
?>
<?php
ob_start();

session_start();

$pageTitle = 'items';

  if(isset($_SESSION['Username'])){
      
          include 'init.php';

          $do = isset($_GET['do'])  ?  $_GET['do'] : 'Manage';

          if($do == 'Manage'){
            echo 'welcome to items';

          }
          elseif($do == 'add'){ ?>
            <h1 class = "text-center  "> Add New Items</h1>
              <div class="container">
                    <form class="form-horizontal" action ="?do=Insert" method ="POST">
                                     
                                     <!-- Start name filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Name</label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="name" 
                                              class="form-control" 
                                              placeholder="Name Of The Item"/>
                                      </div>
                                 </div>
                                      <!-- end name filed -->
                                      
                                       <!-- Start description filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Description</label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="description" 
                                              class="form-control" 
                                              placeholder="Description Of The Item"/>
                                      </div>
                                 </div>
                                       <!-- end description filed -->

                                         <!-- Start Price filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Price</label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="price" 
                                              class="form-control" 
                                              placeholder="Price Of The Item"/>
                                      </div>
                                 </div>
                                       <!-- end price filed -->
                                        <!-- Start Country filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">country </label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="country" 
                                              class="form-control" 
     
                                              placeholder="country of made"/>
                                      </div>
                                 </div>
                                       <!-- end price filed -->

                                       <!-- Start status filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">Status</label>
                                     <div class="col-sm-10">
                                         <select class = "form-control" name="status">
                                         <option value="0">...</option>
                                         <option value="1">NEW</option>
                                         <option value="2"> LIKE NEW</option>
                                         <option value="3">USED</option>
                                         <option value="4">VERY OLD</option>
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end status filed -->
                                        <!-- Start member filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">Member</label>
                                     <div class="col-sm-10">
                                         <select class = "form-control" name="member">
                                         <option value="0">...</option>
                                         <?php

                                          $stmt= $con->prepare("SELECT * FROM users");
                                          $stmt->execute();
                                          $users= $stmt->fetchAll();
                                          foreach($users as $user){
                                             echo "<option value='" .$user['UserID']."'>".$user['Username']."</option> ";
                                          }

                                         ?>
                                         
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end member filed -->
                                        <!-- Start category filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">category</label>
                                     <div class="col-sm-10">
                                         <select class = "form-control" name="category">
                                         <option value="0">...</option>
                                         <?php

                                          $stmt2= $con->prepare("SELECT * FROM categories");
                                          $stmt2->execute();
                                          $cats= $stmt2->fetchAll();
                                          foreach($cats as $cat){
                                             echo "<option value='" .$cat['ID']."'>".$cat['Name']."</option> ";
                                          }

                                         ?>
                                         
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end category filed -->
                                        
                                        <!-- Start submit filed -->
                                   <div class="form-group form-group-lg">
                                        <div class=" col-sm-offset-2 col-sm-10">
                                               <input type="submit" value="Add Item" class="btn btn-primary btn-sm" />
                                         </div>
                                   </div>
                                        <!-- end submit filed -->
                 

              </form>

        </div> 


          <?php

         }elseif($do == 'Insert'){
                         
                          //Insert Member Page
        
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){

                              echo "<h1 class = 'text-center'> Insert Item</h1>";
                              echo "<div class = 'container'> ";
                                  //Get variable from the form
                                  $name    = $_POST['name'];
                                  $desc  = $_POST['description'];
                                  $price  = $_POST['price'];
                                  $country= $_POST['country'];
                                  $status  = $_POST['status'];
                                  $member  =$_POST['member'];
                                  $cat  =$_POST['category'];


                   
                                  //Validate The Form
                                  $formErrors = array();

                                        if(empty($name)){
                                               $formErrors[] = 'name cant be <strong> empty</strong>';
                                        }

                                      if(empty($desc)){
                                             $formErrors[] = 'description Cant Be <strong>Empty</strong>';
                                        }
                                        if(empty($price)){
                                             $formErrors[] = 'price Cant Be <strong>Empty</strong>';
                                        }
                                      if(empty($country)){
                                             $formErrors[] = 'country Cant Be <strong>Empty</strong>';
                                        }
                                     if($status == 0){
                                              $formErrors[] = 'you must choose the <strong>Status</strong>';
                                        }
                                        if ($member == 0) {
                                             $formErrors[] = 'You Must Choose the <strong>Member</strong>';
                                        }
                    
                                        if ($cat == 0) {
                                             $formErrors[] = 'You Must Choose the <strong>Category</strong>';
                                        }
                                    foreach($formErrors as $error){
                                        echo $error;
                                             echo '<div class= "alert alert-danger">'. $error.'</div>' ;
                                        }


                                        //check if theres no error proceed the update operation 
                                     if (empty ($formErrors)){

                                                         $stmt = $con->prepare("INSERT INTO 
                                                                                 items(Name, Description, Price, Country_Made , Status, Add_Date, Cat_ID, Member_ID)
                                                                                 VALUES(:zname, :zdesc, :zprice, :zcountry , :zstatus,now(), :zcat, :zmember)");
                                                         $stmt->execute(array(
                                                                    'zname'     => $name,
                                                                    'zdesc'     => $desc,
                                                                    'zprice'    => $price,
                                                                    'zcountry'  => $country,
                                                                    'zstatus'   => $status,
                                                                    'zcat'		=> $cat,
						                                      'zmember'	=> $member
                                                            
             

                                                          ));
                                        
                                                          //Echo success messag
                                                                 $theMsg = "<div class = 'alert alert-success'>". $stmt->rowCount() . 'Inserted Updated </div>';
                                                                 redirectHome($theMsg , 'back');
                                             
                                        }

                              }else{
                                   echo '<div class ="container">';
                                        $theMsg = '<div class = "alert alert-danger">Sorry you cant Browse this page directly</div>';
                                        redirectHome($theMsg , 'back' );
                                   echo '</div>';
                              } 
                               echo "</div>";       





         }elseif($do == 'edit'){

         }elseif($do == 'update'){
         

         }elseif($do == 'delete'){
          

         }elseif($do == 'approve'){
          

         }
          include $tbl . 'footer.php';
    
    }else{

        header("Location : index.php");
        exit();
    }

ob_end_flush();
?>