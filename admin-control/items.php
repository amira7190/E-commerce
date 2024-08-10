<?php
ob_start();

session_start();

$pageTitle = 'Items';

  if(isset($_SESSION['Username'])){
      
          include 'init.php';

          $do = isset($_GET['do'])  ?  $_GET['do'] : 'Manage';

          if($do == 'Manage'){
               
                    $query = '';
                    if(isset($_GET['page']) && $_GET['page'] == 'pending'){
                         $query = 'AND RegStatus = 0';
                    }
     
                    //Select All Users Execept Admin//
                    $stmt = $con->prepare("SELECT * FROM items");
                    //Execute The Statement
                    $stmt ->execute();
                    //Assign To Variable
                    $items =$stmt->fetchAll();
                 
                 
                 
                 
                 ?> 
                          
                          <h1 class = "text-center  "> Manage items</h1>
                          <div class="container">
                                     <div class="table-responsive">
                                           <table class=" main-table text-center  table table-bordered">
                                             <tr class="bg-secondary text-light">
                                                  <td>#ID</td>
                                                  <td>Name</td>
                                                  <td>Description</td>
                                                  <td>Price</td>
                                                  <td>Category</td>
                                                  <td>Username</td>
                                                  <td>Adding Date</td>
                                                  <td>Control</td>
                                             </tr>
                                             <?php
                                                 foreach($items as $item){
                                                  echo "<tr>";
                                                       echo "<td>" . $item['Item_ID'] . "</td>";
                                                       echo "<td>" . $item['Name'] . "</td>";
                                                       echo "<td>" . $item['Description'] . "</td>";
                                                       echo "<td>" . $item['Price'] . "</td>";
                                                       echo "<td>" . $item['Cat_ID'] . "</td>";
                                                       echo "<td>" . $item['Member_ID'] . "</td>";
                                                       echo "<td>" . $item['Add_Date'] . "</td>";
                                                       echo "<td>
                                                            <a href='items.php?do=Edit&itemid= " .$item['Item_ID'] ." 'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
                                                            <a href= 'itemss.php?do=Delete&itemid= " .$item['Item_ID']. " 'class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
                                             
                                                            
                                                        echo "</td>";
                                                       
                                                  echo "</tr>";
     
                                                 }
                                             ?>
                                             <tr>
                                           </table>
     
                                   </div>
                                   <a href="items.php?do=add" class ="btn btn-sm btn-primary"> <i class ="fa fa-plus"></i> New Item</a>
                          </div>
     
                            
     
     
     
     
     
     
     
     
                      
                               
               <?php

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
                                             echo '<div class= "alert alert-danger">'. $error.'</div>' ;
                                        }


                                        //check if theres no error proceed the update operation 
                                     if (empty ($formErrors)){

                                                         $stmt = $con->prepare("INSERT INTO 
                                                                                 items(Name, Description, Price, Add_Date, Country_Made , Image ,Status , Rating ,Cat_ID, Member_ID)
                                                                                 VALUES(:zname, :zdesc, :zprice , :zdate , :zcountry , :zimage ,:zstatus, :zrating ,:zcat, :zmember)");
                                                         $stmt->execute(array(
                                                                    'zname'     => $name,
                                                                    'zdesc'     => $desc,
                                                                    'zprice'    => $price,
                                                                    'zdate'     =>date("2024-08-01"),
                                                                    'zcountry'  => $country,
                                                                    'zimage'    =>'image',
                                                                    'zstatus'   => $status,
                                                                    'zrating'   => '2',
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





         }elseif($do == 'Edit'){
          //check if Get Request Userid Is Numeric & Get The Integer Value Of It
          $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0 ;

          //echo $userid;

          //Select All Data Depend On Thid ID 
         $stmt = $con->prepare("SELECT * FROM items WHERE  Item_ID = ?  ");
          
         //Execute Query
       $stmt->execute(array($itemid));
         //FetCH THe Data
       $item = $stmt->fetch();
       //The Row Count
      $count=$stmt->rowCount();
       //If There Such Id Show The Form
      if($count > 0){ ?>
          <h1 class = "text-center  "> Edit Items</h1>
              <div class="container">
                    <form class="form-horizontal" action ="?do=Update" method ="POST">
                    <input type="hidden" name="itemid" value="<?php echo $itemid ?>"/>

                                     <!-- Start name filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Name</label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="name" 
                                              class="form-control" 
                                              placeholder="Name Of The Item"
                                              value="<?php echo $item['Name'] ?>"/>
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
                                              placeholder="Description Of The Item"
                                              value="<?php echo $item['Description'] ?>"/>
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
                                              placeholder="Price Of The Item"
                                              value="<?php echo $item['Price'] ?>"/>
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
     
                                              placeholder="country of made"
                                              value="<?php echo $item['Country_Made'] ?>"/>
                                      </div>
                                 </div>
                                       <!-- end price filed -->

                                       <!-- Start status filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">Status</label>
                                     <div class="col-sm-10">
                                         <select class = "form-control" name="status">
                                         
                                         <option value="1"<?php if($item['Status'] == 1 ){ echo 'selected';} ?>   >NEW</option>
                                         <option value="2" <?php if($item['Status'] == 2 ){ echo 'selected';} ?> > LIKE NEW</option>
                                         <option value="3" <?php if($item['Status'] == 3 ){ echo 'selected';} ?> >USED</option>
                                         <option value="4" <?php if($item['Status'] == 4 ){ echo 'selected';} ?> >VERY OLD</option>
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end status filed -->
                                        <!-- Start member filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">Member</label>
                                     <div class="col-sm-10">
                                         <select class = "form-control" name="member">
                                         <?php

                                          $stmt= $con->prepare("SELECT * FROM users");
                                          $stmt->execute();
                                          $users= $stmt->fetchAll();
                                          foreach($users as $user){
                                             echo "<option value='" .$user['UserID']."'";
                                              if($item['Member_ID'] == $user['UserID'] ){ echo 'selected';} 
                                              echo">".$user['Username']."</option> ";
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
                                         <select class = "form-control" name="categories">
                                         <?php

                                          $stmt2= $con->prepare("SELECT * FROM categories");
                                          $stmt2->execute();
                                          $cats= $stmt2->fetchAll();
                                          foreach($cats as $cat){
                                             echo "<option value='" .$cat['ID']."'";
                                             if($item['Cat_ID'] == $cat['ID'] ){ echo 'selected';}
                                             echo">" .$cat['Name']."</option> ";
                                          }

                                         ?>
                                         
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end category filed -->
                                        
                                        <!-- Start submit filed -->
                                   <div class="form-group form-group-lg">
                                        <div class=" col-sm-offset-2 col-sm-10">
                                               <input type="submit" value="Save Item" class="btn btn-primary btn-sm" />
                                         </div>
                                   </div>
                                        <!-- end submit filed -->
                 

              </form>

        </div>
   
<?php  
}
                       //If There is No Such ID Show Error Message 
        else {
             echo "<div class = 'container'>";
                  $theMsg = '<div class = "alert alert-danger">Theres Is No Such ID </div>';
                  redirectHome($theMsg ,);
             echo "</div>";
             }

         }elseif($do == 'Update'){
          echo "<h1 class = 'text-center'> update Item</h1>";
          echo "<div class = 'container'> ";
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
               //Get variable from the form
              $id     = $_POST['itemid'];
              $name   = $_POST['name'];
              $desc   = $_POST['description'];
              $price  = $_POST['price'];
              $country  = $_POST['country'];
              $status  = $_POST['status'];
              $member  = $_POST['member'];
              $cat  = $_POST['category'];





              
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
                                             echo '<div class= "alert alert-danger">'. $error.'</div>' ;
                                        }
              

              //check if theres no error proceed the update operation 
              if (empty ($formErrors)){
                  
                    //UPdate  the database with this info//

                     $stmt = $con->prepare("UPDATE
                                                  items 
                                             SET  Name= ?, 
                                                  Description = ?, 
                                                  Price = ?, 
                                                  Status = ?,
                                                  Country_Made = ?,
                                                  Cat_ID = ?,
                                                  Member_ID = ?  
                                             WHERE 
                                                  ItemID = ? ");
                     $stmt->execute(array($name , $desc , $price ,  $status , $country, $cat, $member, $id));

                     //Echo success message
                      $theMsg = "<div class = 'alert alert-success'>" . $stmt->rowCount() . 'Record Updated </div>';
                      redirectHome ($theMsg , 'back');

              }

           }else{
                    $theMsg= '<div class = "alert alert-danger">you cant Browse this page directly</div>';
                    redirectHome($theMsg);
                } 
            echo "</div>";          


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